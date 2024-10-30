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

?>

<div>
    <div class="py-3 py-md-3 px-3">
        <div class="d-flex w-100 justify-content-between align-items-center border-bottom pb-2 pb-sm-2 mb-3">
            <h3 class="offcanvas-title d-flex align-items-center mb-1">Your Cart
                <span class="fs-6 fw-normal text-muted ms-3">{{ $cartCount }} item(s)</span>
            </h3>
        </div>
        @if ($cartCount > 0)
        @foreach ($cart as $item)
        <div class="d-sm-flex align-items-center pb-4">
            <div class="w-100 pt-1">
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
                            <a class="fs-6 p-2" wire:click="removeFromCart({{$item['id']}})" href="javascript:void(0)"
                                data-bs-toggle="tooltip" aria-label="Remove" data-bs-original-title="Remove Item">
                                <i class="fa-solid fa-trash text-danger"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="d-flex align-items-center justify-content-center py-4">
            <span class="fs-xl font--bold">Your cart is empty</span>
        </div>
        @endif

    </div>

    <div class="d-flex align-items-center justify-content-between border-top pt-4 px-3">
        <span class="fs-xl font--bold">Total:</span>
        <span class="fs-3 font--bold text-dark ms-2">${{ number_format($cartTotal, 2) }}</span>
    </div>
</div>
