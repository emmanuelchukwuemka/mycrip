<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Services\PaystackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    protected PaystackService $paystack;

    public function __construct(PaystackService $paystack)
    {
        $this->paystack = $paystack;
    }

    /**
     * Initialize promotion payment.
     */
    public function promote(Request $request, Property $property)
    {
        if ($property->user_id !== Auth::id()) {
            abort(403);
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
