<?php

namespace App\Http\Controllers;

use App\Services\CheckoutService;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;

class PayPalController extends Controller
{
    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    public function checkout()
    {
        $amount = session()->get('cartTotal', 0);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.success'),
                "cancel_url" => route('paypal.cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $amount
                    ]
                ]
            ]
        ]);

        if (isset($response['id'])) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect($link['href']);
                }
            }
        }

        return redirect()->route('paypal.cancel');
    }

    public function success(Request $request)
    {
        $total = session()->get('cartTotal', 0);
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            // Payment successful, you can handle your business logic here
            $this->checkoutService->processCheckout([
                'user_id' => auth()->id(),
                'total' => $total,
            ]);

            return redirect()->route('cart')->with('success', 'Order placed successfully!');
        }

        return redirect()->route('cart')->with('error', 'Payment Failed!');
    }

    public function cancel()
    {
        // Payment was cancelled, redirect or show message
        return redirect()->route('cart')->with('error', 'Payment Cancelled!');
    }
}
