<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Services\PaystackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaystackController extends Controller
{
    protected PaystackService $paystackService;

    public function __construct(PaystackService $paystackService)
    {
        $this->paystackService = $paystackService;
    }

    /**
     * Handle Paystack webhook.
     */
    public function handle(Request $request)
    {
        $signature = $_SERVER['HTTP_X_PAYSTACK_SIGNATURE'] ?? '';
        $rawBody = file_get_contents('php://input');

        // Verify webhook signature
        if (!$this->paystackService->verifyWebhookSignature($signature, $rawBody)) {
            Log::error('Invalid Paystack webhook signature');
            return response('Invalid signature', 401);
        }

        $event = json_decode($rawBody, true);

        if ($event['event'] === 'charge.success') {
            $this->handleChargeSuccess($event);
        } elseif ($event['event'] === 'subscription.create') {
            $this->handleSubscriptionCreated($event);
        } elseif ($event['event'] === 'subscription.disable') {
            $this->handleSubscriptionDisabled($event);
        } elseif ($event['event'] === 'invoice.update') {
            $this->handleInvoiceUpdate($event);
        }

        return response('OK', 200);
    }

    /**
     * Handle charge success event.
     */
    protected function handleChargeSuccess(array $event)
    {
        $data = $event['data'];
        $reference = $data['reference'];
        $metadata = $data['metadata'] ?? [];

        // Check if this is a subscription payment
        if (isset($metadata['type']) && $metadata['type'] === 'subscription') {
            $this->processSubscriptionPayment($data);
        } elseif (isset($metadata['type']) && $metadata['type'] === 'promotion') {
            $this->processPromotionPayment($data);
        }
    }

    /**
     * Process subscription payment.
     */
    protected function processSubscriptionPayment(array $data)
    {
        $metadata = $data['metadata'];
        $planId = $metadata['plan_id'] ?? null;
        $userId = $metadata['user_id'] ?? null;

        if (!$planId || !$userId) {
            Log::error('Missing plan_id or user_id in subscription payment metadata', $metadata);
            return;
        }

        // Find the pending subscription and update it
        $subscription = Subscription::where('user_id', $userId)
            ->where('plan_id', $planId)
            ->where('status', 'pending')
            ->first();

        if ($subscription) {
            $plan = $subscription->plan;
            $startDate = now();
            $endDate = $plan->interval === 'annually' ? $startDate->addYear() : $startDate->addMonth();
            
            $subscription->update([
                'status' => 'active',
                'start_date' => $startDate,
                'end_date' => $endDate,
                'next_payment_date' => $plan->interval === 'annually' ? $startDate->addYear() : $startDate->addMonth(),
                'paystack_subscription_id' => $data['subscription']['subscription_code'] ?? null,
                'paystack_customer_id' => $data['customer']['customer_code'] ?? null,
            ]);
        }
    }

    /**
     * Process promotion payment.
     */
    protected function processPromotionPayment(array $data)
    {
        $metadata = $data['metadata'];
        $propertyId = $metadata['property_id'] ?? null;

        if (!$propertyId) {
            Log::error('Missing property_id in promotion payment metadata', $metadata);
            return;
        }

        // Update property with promotion
        $property = \App\Models\Property::find($propertyId);
        if ($property) {
            $property->update([
                'is_featured' => true,
                'featured_until' => now()->addDays(30), // 30 days promotion
            ]);
        }
    }

    /**
     * Handle subscription created event.
     */
    protected function handleSubscriptionCreated(array $event)
    {
        $data = $event['data'];
        $subscriptionCode = $data['subscription_code'];
        
        // Update subscription with Paystack subscription ID
        $subscription = Subscription::where('paystack_subscription_id', $subscriptionCode)->first();
        
        if ($subscription) {
            $subscription->update([
                'paystack_subscription_id' => $subscriptionCode,
            ]);
        }
    }

    /**
     * Handle subscription disabled event.
     */
    protected function handleSubscriptionDisabled(array $event)
    {
        $data = $event['data'];
        $subscriptionCode = $data['subscription_code'];
        
        // Mark subscription as cancelled
        $subscription = Subscription::where('paystack_subscription_id', $subscriptionCode)->first();
        
        if ($subscription) {
            $subscription->update([
                'status' => 'cancelled',
                'cancelled_at' => now(),
            ]);
        }
    }

    /**
     * Handle invoice update event.
     */
    protected function handleInvoiceUpdate(array $event)
    {
        $data = $event['data'];
        $subscriptionCode = $data['subscription']['subscription_code'] ?? null;
        
        if ($subscriptionCode) {
            $subscription = Subscription::where('paystack_subscription_id', $subscriptionCode)->first();
            
            if ($subscription) {
                // Update next payment date
                $subscription->update([
                    'next_payment_date' => $data['next_payment_date'] ?? null,
                ]);
            }
        }
    }
}
