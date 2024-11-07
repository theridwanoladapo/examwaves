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

    public function buyNow($itemid)
    {
        $item = Certification::find($itemid);

        $cart[$item->id] = [
            'id' => $item->id,
            'title' => $item->title,
            'code' => $item->code,
            'price' => $item->price,
            'exam_id' => $item->exam_id
        ];

        session()->put('cart', $cart);
        session()->put('cartTotal', $item->price);

        return view('user.buy-now', compact('item'));
    }
}
