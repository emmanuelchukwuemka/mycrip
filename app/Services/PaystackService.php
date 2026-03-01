<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaystackService
{
    protected ?string $secretKey;
    protected string $baseUrl = 'https://api.paystack.co';

    public function __construct()
    {
        $this->secretKey = config('services.paystack.secret_key') ?: env('PAYSTACK_SECRET_KEY');
    }

    /**
     * Check if Paystack is configured with a real (non-placeholder) key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->secretKey)
            && !str_contains($this->secretKey, 'dummy')
            && !str_contains($this->secretKey, 'your_')
            && str_starts_with($this->secretKey, 'sk_');
    }

    /**
     * Initialize a transaction.
     */
    public function initializeTransaction(array $data)
    {
        if (!$this->secretKey) {
            Log::error('Paystack Secret Key not configured');
            return null;
        }
        
        try {
            $response = Http::withToken($this->secretKey)
                ->post("{$this->baseUrl}/transaction/initialize", [
                    'amount' => $data['amount'] * 100, // Paystack amount is in kobo
                    'email' => $data['email'],
                    'reference' => $data['reference'],
                    'callback_url' => $data['callback_url'],
                    'metadata' => $data['metadata'] ?? [],
                ]);

            if ($response->successful()) {
                return $response->json()['data'];
            }

            Log::error('Paystack Initialization Failed', ['response' => $response->json()]);
            return null;
        } catch (\Exception $e) {
            Log::error('Paystack Service Error', ['message' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Verify a transaction.
     */
    public function verifyTransaction(string $reference)
    {
        if (!$this->secretKey) {
            Log::error('Paystack Secret Key not configured');
            return null;
        }
        
        try {
            $response = Http::withToken($this->secretKey)
                ->get("{$this->baseUrl}/transaction/verify/{$reference}");

            if ($response->successful()) {
                return $response->json()['data'];
            }

            Log::error('Paystack Verification Failed', ['reference' => $reference, 'response' => $response->json()]);
            return null;
        } catch (\Exception $e) {
            Log::error('Paystack Verification Error', ['message' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Create a customer in Paystack.
     */
    public function createCustomer(array $data)
    {
        if (!$this->secretKey) {
            Log::error('Paystack Secret Key not configured');
            return null;
        }
        
        try {
            $response = Http::withToken($this->secretKey)
                ->post("{$this->baseUrl}/customer", $data);

            if ($response->successful()) {
                return $response->json()['data'];
            }

            Log::error('Paystack Customer Creation Failed', ['response' => $response->json()]);
            return null;
        } catch (\Exception $e) {
            Log::error('Paystack Customer Creation Error', ['message' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Create a subscription in Paystack.
     */
    public function createSubscription(array $data)
    {
        if (!$this->secretKey) {
            Log::error('Paystack Secret Key not configured');
            return null;
        }
        
        try {
            $response = Http::withToken($this->secretKey)
                ->post("{$this->baseUrl}/subscription", $data);

            if ($response->successful()) {
                return $response->json()['data'];
            }

            Log::error('Paystack Subscription Creation Failed', ['response' => $response->json()]);
            return null;
        } catch (\Exception $e) {
            Log::error('Paystack Subscription Creation Error', ['message' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Fetch subscription details.
     */
    public function getSubscription(string $subscriptionId)
    {
        if (!$this->secretKey) {
            Log::error('Paystack Secret Key not configured');
            return null;
        }
        
        try {
            $response = Http::withToken($this->secretKey)
                ->get("{$this->baseUrl}/subscription/{$subscriptionId}");

            if ($response->successful()) {
                return $response->json()['data'];
            }

            Log::error('Paystack Subscription Fetch Failed', ['subscription_id' => $subscriptionId, 'response' => $response->json()]);
            return null;
        } catch (\Exception $e) {
            Log::error('Paystack Subscription Fetch Error', ['message' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Cancel a subscription.
     */
    public function cancelSubscription(string $subscriptionId, string $code = 'not_satisfied')
    {
        if (!$this->secretKey) {
            Log::error('Paystack Secret Key not configured');
            return null;
        }
        
        try {
            $response = Http::withToken($this->secretKey)
                ->post("{$this->baseUrl}/subscription/cancel", [
                    'code' => $code,
                    'subscription_code' => $subscriptionId,
                ]);

            if ($response->successful()) {
                return $response->json()['data'];
            }

            Log::error('Paystack Subscription Cancellation Failed', ['subscription_id' => $subscriptionId, 'response' => $response->json()]);
            return null;
        } catch (\Exception $e) {
            Log::error('Paystack Subscription Cancellation Error', ['message' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Fetch plan details.
     */
    public function getPlan(string $planId)
    {
        if (!$this->secretKey) {
            Log::error('Paystack Secret Key not configured');
            return null;
        }
        
        try {
            $response = Http::withToken($this->secretKey)
                ->get("{$this->baseUrl}/plan/{$planId}");

            if ($response->successful()) {
                return $response->json()['data'];
            }

            Log::error('Paystack Plan Fetch Failed', ['plan_id' => $planId, 'response' => $response->json()]);
            return null;
        } catch (\Exception $e) {
            Log::error('Paystack Plan Fetch Error', ['message' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Verify webhook signature.
     */
    public function verifyWebhookSignature(string $signature, string $rawBody): bool
    {
        if (!$this->secretKey) {
            return false;
        }
        
        $computedSignature = hash_hmac('sha512', $rawBody, $this->secretKey);
        return hash_equals($signature, $computedSignature);
    }
}
