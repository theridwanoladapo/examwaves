<?php

use function Livewire\Volt\{state, mount};

state(['cart', 'cartCount', 'cartTotal', 'payment_gateway' => 'paystack']);

mount(function () {
    // Initialize the cart, cartCount & cartTotal retrieved from session
    $this->cart = session()->get('cart', []);
    $this->cartCount = session()->get('cartCount', 0);
    $this->cartTotal = session()->get('cartTotal', 0);
});

$proceedToCheckout = function () {
    $this->redirectRoute('checkout', [$this->payment_gateway], navigate: true);
}

?>

<div>
    <!-- Session Status -->
    @if(session()->has('success'))
    <div class="font-medium text-success">
        {{ session()->get('success') }}
    </div>
    @endif
    @if(session()->has('error'))
    <div class="font-medium text-danger">
        {{ session()->get('error') }}
    </div>
    @endif

    <div class="gray-simple rounded-2 py-3 px-4 mt-5 mt-lg-2 ">
        <h1 class="fs-2 pb-3">Checkout</h1>

        <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
            @csrf
            <input type="hidden" name="email" value="{{ auth()->user()->email }}"> {{-- required --}}
            <input type="hidden" name="orderID" value="1234">
            <input type="hidden" name="amount" value="{{ $cartTotal * 100 }}"> {{-- amount in kobo --}}
            <input type="hidden" name="currency" value="NGN">
            {{-- <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value']) }}" > --}}
            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
            <button class="btn btn-lg btn-success w-100 px-xl-5 mb-4" type="submit">Checkout with Paystack</button>
        </form>

        <a href="{{ route('paypal.checkout') }}" class="btn btn-lg btn-primary w-100 px-xl-5">Checkout with PayPal</a>

        {{-- <form wire:submit="proceedToCheckout">
            <h3 class="d-flex align-items-center fs-6 lh-base font--bold">Pay with:</h3>
            <div class="form-check bg-white rounded-2 p-3 mb-4">
                <input wire:model="payment_gateway" class="form-check-input ms-1" type="radio" value="paystack" name="payment_gateway" id="cash">
                <label class="form-check-label ms-3" for="cash">
                    <span>
                        <span class="d-block fs-base text-dark fw-medium mb-1">Paystack</span>
                    </span>
                </label>
            </div>
            <div class="form-check bg-white rounded-2 p-3 mb-4">
                <input wire:model="payment_gateway" class="form-check-input ms-1" type="radio" value="paypal" name="payment_gateway" id="card">
                <label class="form-check-label ms-3" for="card">
                    <span>
                        <span class="d-block fs-base text-dark fw-medium mb-1">Paypal</span>
                    </span>
                </label>
            </div>

            <div class="d-lg-block pt-5 mt-n3">
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="save-info" checked>
                    <label class="form-check-label ms-2" for="save-info">
                        <span class="text-muted">Your personal information will be used to process your order, to support your experience on this site and for other purposes described in the </span>
                        <a class="fw-medium" href="#">privacy policy</a>
                    </label>
                </div>
                <button class="btn btn-lg btn-primary px-xl-5" type="submit">Place An Order</button>
            </div>
        </form> --}}

    </div>
</div>
