<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Plan;
use App\Models\Subscription;
use App\Services\PaystackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected PaystackService $paystack;

    public function __construct(PaystackService $paystack)
    {
        $this->paystack = $paystack;
    }

    /**
     * Show subscription plans.
     */
    public function plans()
    {
        $plans = Plan::where('is_active', true)->orderBy('price')->get();
        $currentSubscription = Auth::user()->subscriptions()->where('status', 'active')->first();

        return view('agent.billing.plans', compact('plans', 'currentSubscription'));
    }

    /**
     * Subscribe to a plan.
     */
    public function subscribe(Request $request, Plan $plan)
    {
        if (!$plan->is_active) {
            return back()->with('error', 'This plan is not available.');
        }

        // Check if Paystack is configured
        if (!$this->paystack->isConfigured()) {
            // In local development without Paystack configured, just activate the subscription directly
            if (app()->environment('local')) {
                $startDate = now();
                $endDate = $plan->interval === 'annually' ? $startDate->addYear() : $startDate->addMonth();
                
                $subscription = Subscription::create([
                    'user_id' => Auth::id(),
                    'plan_id' => $plan->id,
                    'status' => 'active',
                    'amount' => $plan->price,
                    'currency' => $plan->currency,
                    'interval' => $plan->interval,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'next_payment_date' => $plan->interval === 'annually' ? $startDate->addYear() : $startDate->addMonth(),
                ]);
                
                return redirect()->route('agent.subscription')->with('success', 'Subscription activated successfully! (Demo mode)');
            } else {
                return back()->with('error', 'Payment gateway not configured. Please contact administrator.');
            }
        }

        $reference = 'SUB_' . Str::random(10);
        $amount = $plan->price;

        $data = [
            'amount' => $amount,
            'email' => Auth::user()->email,
            'reference' => $reference,
            'callback_url' => route('agent.subscription.callback'),
            'metadata' => [
                'plan_id' => $plan->id,
                'user_id' => Auth::id(),
                'type' => 'subscription'
            ]
        ];

        $paymentDetails = $this->paystack->initializeTransaction($data);

        if ($paymentDetails) {
            return redirect($paymentDetails['authorization_url']);
        }

        return back()->with('error', 'Could not initialize payment. Please try again.');
    }

    /**
     * Handle subscription payment callback.
     */
    public function subscriptionCallback(Request $request)
    {
        $reference = $request->query('reference');
        
        if (!$reference) {
            return redirect()->route('agent.subscription')->with('error', 'Invalid payment reference.');
        }

        // Check if Paystack is configured
        if (!$this->paystack->isConfigured()) {
            // In local development, just return success since we already created the subscription
            if (app()->environment('local')) {
                return redirect()->route('agent.subscription')->with('success', 'Subscription activated successfully! (Demo mode)');
            } else {
                return redirect()->route('agent.subscription')->with('error', 'Payment gateway not configured.');
            }
        }

        $paymentData = $this->paystack->verifyTransaction($reference);

        if ($paymentData && $paymentData['status'] === 'success') {
            $planId = $paymentData['metadata']['plan_id'];
            $userId = $paymentData['metadata']['user_id'];
            $plan = Plan::findOrFail($planId);

            // Create subscription record
            $startDate = now();
            $endDate = $plan->interval === 'annually' ? $startDate->addYear() : $startDate->addMonth();
            
            $subscription = Subscription::create([
                'user_id' => $userId,
                'plan_id' => $planId,
                'status' => 'active',
                'amount' => $plan->price,
                'currency' => $plan->currency,
                'interval' => $plan->interval,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'next_payment_date' => $plan->interval === 'annually' ? $startDate->addYear() : $startDate->addMonth(),
            ]);

            return redirect()->route('agent.subscription')->with('success', 'Subscription activated successfully!');
        }

        return redirect()->route('agent.subscription')->with('error', 'Payment verification failed.');
    }

    /**
     * Cancel current subscription.
     */
    public function cancelSubscription(Subscription $subscription)
    {
        if ($subscription->user_id !== Auth::id() || !$subscription->isActive()) {
            abort(403);
        }

        $subscription->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
        ]);

        return redirect()->route('agent.subscription')->with('success', 'Subscription cancelled successfully.');
    }

    /**
     * Show billing history.
     */
    public function billingHistory()
    {
        $subscriptions = Auth::user()->subscriptions()->orderByDesc('created_at')->get();
        
        return view('agent.billing.history', compact('subscriptions'));
    }

    /**
     * Initialize promotion payment.
     */
    public function promote(Request $request, Property $property)
    {
        if ($property->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if Paystack is configured
        if (!$this->paystack->isConfigured()) {
            // In local development without Paystack configured, just promote the property directly
            if (app()->environment('local')) {
                $property->update([
                    'is_featured' => true,
                    'featured_until' => now()->addDays(30), // 30 days promotion
                ]);
                
                return redirect()->route('agent.properties.index')->with('success', 'Your property has been promoted successfully! (Demo mode)');
            } else {
                return back()->with('error', 'Payment gateway not configured. Please contact administrator.');
            }
        }

        // Define promotion details (e.g., 5000 NGN for 30 days)
        $amount = 5000; 
        $reference = 'PROM_' . Str::random(10);

        $data = [
            'amount' => $amount,
            'email' => Auth::user()->email,
            'reference' => $reference,
            'callback_url' => route('agent.payments.callback'),
            'metadata' => [
                'property_id' => $property->id,
                'agent_id' => Auth::id(),
                'type' => 'promotion'
            ]
        ];

        $paymentDetails = $this->paystack->initializeTransaction($data);

        if ($paymentDetails) {
            return redirect($paymentDetails['authorization_url']);
        }

        return back()->with('error', 'Could not initialize payment. Please try again.');
    }

    /**
     * Handle payment callback.
     */
    public function callback(Request $request)
    {
        $reference = $request->query('reference');
        
        if (!$reference) {
            return redirect()->route('agent.properties.index')->with('error', 'Invalid payment reference.');
        }

        // Check if Paystack is configured
        if (!$this->paystack->isConfigured()) {
            // In local development, we already promoted the property in the promote method
            if (app()->environment('local')) {
                return redirect()->route('agent.properties.index')->with('success', 'Your property has been promoted successfully! (Demo mode)');
            } else {
                return redirect()->route('agent.properties.index')->with('error', 'Payment gateway not configured.');
            }
        }

        $paymentData = $this->paystack->verifyTransaction($reference);

        if ($paymentData && $paymentData['status'] === 'success') {
            $propertyId = $paymentData['metadata']['property_id'];
            $property = Property::findOrFail($propertyId);

            $property->update([
                'is_featured' => true,
                'featured_until' => now()->addDays(30), // 30 days promotion
            ]);

            return redirect()->route('agent.properties.index')->with('success', 'Your property has been promoted successfully!');
        }

        return redirect()->route('agent.properties.index')->with('error', 'Payment verification failed.');
    }
}
