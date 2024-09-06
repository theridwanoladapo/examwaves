<?php

namespace App\Services;

use App\Models\Certification;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected $certification;

    /**
     * Create a new class instance.
     */
    public function __construct(Certification $certification)
    {
        $this->$certification = $certification;
    }

    /**
     * Add an item to the cart.
     *
     * @param int $item_id
     * @return void
     */
    public function addToCart($item_id)
    {
        $certification = $this->certification->find($item_id);

        $cart = Session::get('cart', []);

        if (isset($cart[$item_id])) {
            // If certification is already in the cart, return
            return;
        } else {
            // Add new certification to the cart
            $cart[$item_id] = [
                'id' => $certification->id,
                'title' => $certification->title,
                'code' => $certification->code,
                'price' => $certification->price,
                'exam_id' => $certification->exam_id,
            ];
        }

        Session::put('cart', $cart);    // Save the updated cart to the session.
    }

    /**
     * Remove an item from the cart.
     *
     * @param int $item_id
     * @return void
     */
    public function removeFromCart($item_id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$item_id])) {
            unset($cart[$item_id]);

            Session::put('cart', $cart);
        } else {
            throw new \Exception("Product not found in cart.");
        }
    }

    /**
     * Get the total cost of items in the cart.
     *
     * @return float
     */
    public function getCartTotal()
    {
        $cart = Session::get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'];
        }

        return $total;
    }

    /**
     * Clear the cart after checkout.
     *
     * @return void
     */
    public function clearCart()
    {
        Session::forget('cart');
    }
}
