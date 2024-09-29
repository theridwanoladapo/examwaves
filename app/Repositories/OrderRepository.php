<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    public function createOrder(array $data, array $cartItems, $status)
    {
        return DB::transaction(function () use ($data, $cartItems, $status) {
            // Create the order
            $order = Order::create([
                'user_id' => $data['user_id'],
                'total' => $data['total'],
                'status' => $status,
            ]);

            // Add each item to the order
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'certification_id' => $item['id'],
                    'price' => $item['price'],
                    'isActive' => 1,
                ]);
            }

            return $order;
        });
    }
}
