<?php

use App\Models\Certification;

use function Livewire\Volt\{state, mount, on};

state(['cart', 'cartCount', 'cartTotal']);

mount(function () {
    // Initialize the cart, cartCount & cartTotal retrieved from session
    $this->cart = session()->get('cart', []);
    $this->cartCount = session()->get('cartCount', 0);
    $this->cartTotal = session()->get('cartTotal', 0);
});

on(['cartUpdated' => function () {
    $this->cart = session()->get('cart', []);
    $this->cartCount = session()->get('cartCount', 0);
    $this->cartTotal = session()->get('cartTotal', 0);
}]);

$removeFromCart = function (int $id) {
    $cert = Certification::find($id);

    $this->cart = session()->get('cart', []);

    if (array_key_exists($id, $this->cart)) {
        unset($this->cart[$id]);    // remove item from cart array

        $this->cartCount--;
        $this->cartTotal -= $cert->price;
    }

    session()->put('cart', $this->cart);
    session()->put('cartCount', $this->cartCount);
    session()->put('cartTotal', $this->cartTotal);

    $this->dispatch('cartUpdated');
};

/* $clearCart = function () {
    $this->cart = [];
    $this->cartCount = 0;
    $this->cartTotal = 0;

    session()->put('cart', $this->cart);
    session()->put('cartCount', $this->cartCount);
    session()->put('cartTotal', $this->cartTotal);

    $this->dispatch('cartUpdated');
} */

?>

<div>
    <div class="py-3 py-md-3">
        <div class="d-flex w-100 justify-content-between align-items-center border-bottom pb-2 pb-sm-2 mb-3">
            <h3 class="offcanvas-title d-flex align-items-center mb-1">Your Cart
                <span class="fs-6 fw-normal text-muted ms-3">{{ $cartCount }} item(s)</span>
            </h3>
        </div>

        @foreach ($cart as $item)
        <div class="d-sm-flex align-items-center pb-4">
            <div class="w-100 pt-1">
                <div class="">
                    <div class="d-flex justify-content-between">
                        <div class="me-3">
                            <h6 class="">
                                <a href="{{ route('admin.certifications.view', $item['id']) }}">{{ $item['title'] }} ({{ $item['code'] }})</a>
                            </h6>
                            <div class="text-muted fs-sm me-3">Exam Provider: <span class="text-dark fw-medium">{{ exam_provider_name($item['exam_id']) }}</span></div>
                        </div>
                        <div class="text-end ms-auto">
                            <h6 class="font--bold">${{ number_format($item['price'], 2) }}</h6>
                            <a class="fs-6 p-2" wire:click="removeFromCart({{$item['id']}})" href="javascript:void(0)"
                                data-bs-toggle="tooltip" aria-label="Remove" data-bs-original-title="Remove Item">
                                <i class="fa-solid fa-trash text-danger"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    <!-- Coupon Code -->
    {{-- <div class="pb-3">
        <div class="d-sm-flex align-items-center border-top pt-4">
            <div class="input-group input-group-sm mb-3 mb-sm-0 me-sm-4 me-md-5 p-2 border rounded-3">
                <input class="form-control form-control-md text-uppercase border-0" type="text"
                    placeholder="Your coupon code">
                <button class="btn btn-md btn-primary rounded-2" type="button">Apply coupon</button>
            </div>
        </div>
    </div> --}}

    <!-- Total Price & GST -->
    {{-- <ul class="list-unstyled py-3 mb-0">
        <li class="d-flex justify-content-between mb-2">Subtotal:<span class="fw-semibold ms-2">$172.00</span></li>
        <li class="d-flex justify-content-between mb-2">GST:<span class="fw-semibold ms-2">$22.00</span></li>
        <li class="d-flex justify-content-between mb-2">Shipping Cost:<span class="fw-semibold ms-2">$12.00</span></li>
    </ul> --}}

    <div class="d-flex align-items-center justify-content-between border-top pt-4">
        <span class="fs-xl font--bold">Total:</span>
        <span class="fs-3 font--bold text-dark ms-2">${{ number_format($cartTotal, 2) }}</span>
    </div>
</div>