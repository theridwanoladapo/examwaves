<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Services\CheckoutService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = $this->checkoutService->getCartItemsForCheckout();
        return view('user.cart', compact('cartItems'));
    }

    public function buyNow($id)
    {
        $item = Certification::find($id);

        return view('user.buy-now', compact('item'));
    }
}
