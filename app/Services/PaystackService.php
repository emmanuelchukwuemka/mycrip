<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaystackService
{
    protected string $secretKey;
    protected string $baseUrl = 'https://api.paystack.co';

    public function __construct()
    {
        $this->secretKey = config('services.paystack.secret_key', env('PAYSTACK_SECRET_KEY', ''));
    }

    /**
     * Initialize a transaction.
     */
    public function initializeTransaction(array $data)
    {
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
}
