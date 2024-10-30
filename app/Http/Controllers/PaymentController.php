<?php

namespace App\Http\Controllers;

use App\Services\CheckoutService;
use Illuminate\Http\Request;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{
    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    public function redirectToGateway(Request $request)
    {
        try {
            return Paystack::getAuthorizationUrl()->redirectNow();
        } catch (\Exception $e) {
            return back()->withError('Error: ' . $e->getMessage());
        }
    }

    public function handleGatewayCallback()
    {
        $total = session()->get('cartTotal', 0);
        $paymentDetails = Paystack::getPaymentData();

        // Check if payment was successful
        if ($paymentDetails['status'] == 'success') {
            // Process your payment confirmation (e.g., save to the database)
            $this->checkoutService->processCheckout([
                'user_id' => auth()->id(),
                'total' => $total,
            ]);

            return redirect()->route('order-success')->with('success', 'Order placed successfully!');
        } else {
            return redirect()->route('cart')->with('error', 'Payment failed.');
        }
    }

    public function handleWebhook(Request $request)
    {
        // Paystack sends a POST request with the transaction details
        $data = $request->all();
        // Verify transaction, store in the database, etc.
    }
}
