<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    public function createOrder(array $data, array $cartItems)
    {
        return DB::transaction(function () use ($data, $cartItems) {
            // Create the order
            $order = Order::create([
                'user_id' => $data['user_id'],
                'total' => $data['total'],
                'status' => 'pending',
            ]);

            // Add each item to the order
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            return $order;
        });
    }
}
