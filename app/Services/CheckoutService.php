<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Session;

class CheckoutService
{
    protected $orderRepository;

    /**
     * Create a new class instance.
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getCartItemsForCheckout()
    {
        return Session::get('cart', []);
    }

    public function processCheckout($data)
    {
        $cartItems = $this->getCartItemsForCheckout();
        $order = $this->orderRepository->createOrder($data, $cartItems, 'success');
        Session::forget('cart');
        Session::forget('cartCount');
        Session::forget('cartTotal');
        return $order;
    }
}
