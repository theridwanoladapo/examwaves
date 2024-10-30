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

$clearCart = function () {
    $this->cart = [];
    $this->cartCount = 0;
    $this->cartTotal = 0;

    session()->put('cart', $this->cart);
    session()->put('cartCount', $this->cartCount);
    session()->put('cartTotal', $this->cartTotal);

    $this->dispatch('cartUpdated');
}

?>

<div>
    <ul class="nav-menu nav-menu-social align-to-right">
        <li>
            <a data-bs-toggle="offcanvas" href="#offcanvasProduct" role="button" aria-controls="offcanvasProduct" class="nav-link text-primary position-relative ms-2">
                <i class="fa-solid fa-basket-shopping fs-5"></i>
                <span class="badge bg-primary fs-xs position-absolute end-0 top-0 circle">{{ $cartCount }}</span>
            </a>
        </li>
    </ul>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasProduct" aria-labelledby="offcanvasProductLabel">
        <div class="offcanvas-header" id="offcanvasProductLabel">
            <div class="d-flex w-100 justify-content-between align-items-center border-bottom pb-3 pb-sm-4">
                <h3 class="offcanvas-title d-flex align-items-center mb-1">Your Cart
                    <span class="fs-6 fw-normal text-muted ms-3">{{ $cartCount }} item(s)</span>
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
        </div>
        <div class="offcanvas-body">

            @foreach ($cart as $item)
            <div class="d-sm-flex align-items-center pb-4">
                <div class="w-100 pt-1 ps-sm-4">
                    <div class="">
                        <div class="d-flex justify-content-between">
                            <div class="me-3">
                                <h6 class="">
                                    <a href="{{ route('admin.certifications.view', $item['id']) }}">
                                        {{ $item['title'] }} {{ $item['code'] ? '('.$item['code'].')' : null }}</a>
                                </h6>
                                <div class="text-muted fs-sm me-3">Exam Provider: <span class="text-dark fw-medium">{{ exam_provider_name($item['exam_id']) }}</span></div>
                            </div>
                            <div class="text-end ms-auto">
                                <h6 class="font--bold">${{ number_format($item['price'], 2) }}</h6>
                                <a class="fs-sm" wire:click="removeFromCart({{$item['id']}})" href="javascript:void(0)"
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
        <div class="px-4 pb-3 pb-sm-4 pb-sm-5">
            <div class="d-sm-flex align-items-center justify-content-between border-top pt-4">
                <div>
                    <button type="button" wire:click="clearCart" class="btn btn-md btn-danger rounded-2">Clear Cart</button>
                </div>
                <div class="d-flex align-items-center justify-content-end">
                    <span class="fs-xl font--bold me-3">Total:</span>
                    <span class="h3 mb-0 font--bold">${{ number_format($cartTotal, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Checkout -->
        <div class="d-flex align-items-center justify-content-between px-4 pb-3">
            <div class="nav d-none d-sm-block">
                <a class="text-muted font--medium px-0" href="#cartOffcanvas" data-bs-dismiss="offcanvas">
                    <i class="fa-solid fa-arrow-left me-2"></i>Back to shop</a>
            </div>
            <a class="btn btn-lg btn-primary w-sm-auto" href="{{ route('cart') }}">Go to Cart<i class="ai-chevron-right ms-2 me-n1"></i></a>
        </div>
    </div>
</div>
