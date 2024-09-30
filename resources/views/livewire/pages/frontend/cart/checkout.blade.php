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

        @if ($cart)
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
        @else
        <div class="d-flex align-items-center justify-content-center py-5 border rounded bg-white">
            <span class="h6 font--bold">Your cart is empty</span>
        </div>
        @endif

    </div>
</div>