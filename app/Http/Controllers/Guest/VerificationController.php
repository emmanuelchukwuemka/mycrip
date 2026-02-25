<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\VerificationRequest;
use App\Services\PaystackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VerificationController extends Controller
{
    protected $paystackService;
    protected $verificationFee = 25000; // ₦25,000 for title verification

    public function __construct(PaystackService $paystackService)
    {
        $this->paystackService = $paystackService;
    }

    /**
     * Initialize the verification request and payment.
     */
    public function verify(Property $property)
    {
        $user = Auth::user();
        $reference = 'VER-' . Str::random(10);

        $paymentData = [
            'amount' => $this->verificationFee,
            'email' => $user->email,
            'reference' => $reference,
            'callback_url' => route('verification.callback'),
            'metadata' => [
                'property_id' => $property->id,
                'user_id' => $user->id,
                'type' => 'title_verification'
            ],
        ];

        $initialize = $this->paystackService->initializeTransaction($paymentData);

        if ($initialize) {
            // Create a pending verification request
            VerificationRequest::create([
                'user_id' => $user->id,
                'property_id' => $property->id,
                'payment_reference' => $reference,
                'amount' => $this->verificationFee,
                'status' => 'pending',
            ]);

            return redirect($initialize['authorization_url']);
        }

        return back()->with('error', 'Unable to initialize title verification. Please try again.');
    }

    /**
     * Handle Paystack callback.
     */
    public function callback(Request $request)
    {
        $reference = $request->query('reference');
        
        if (!$reference) {
            return redirect()->route('home')->with('error', 'No reference found in the callback.');
        }

        $verification = $this->paystackService->verifyTransaction($reference);

        if ($verification && $verification['status'] === 'success') {
            $metadata = $verification['metadata'];
            
            $req = VerificationRequest::where('payment_reference', $reference)->first();
            
            if ($req) {
                $req->update(['status' => 'in_progress']);

                return redirect()->route('guest.properties.show', $req->property_id)
                    ->with('success', 'Payment successful! Our experts will now begin verifying the title for this property.');
            }
        }

        return redirect()->route('home')->with('error', 'Title verification payment failed or was cancelled.');
    }
}
