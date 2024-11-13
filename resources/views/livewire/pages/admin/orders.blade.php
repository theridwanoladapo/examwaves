<?php

use App\Models\OrderItem;

use function Livewire\Volt\{with, usesPagination};

usesPagination(theme: 'bootstrap');

with(fn () => ['orders' => OrderItem::latest()->paginate(10)]);

?>

<div>
    <div class="dash-wrapsw card border-0 rounded-4 py-4 mb-4">
        <div class="card-body px-4">
            <div class="d-sm-flex align-items-center mb-4">
                <h1 class="h4 text-dark mb-4 mb-sm-0 me-4">
                    <i class="fa-solid fa-pen-fancy text-primary me-2"></i> Orders
                </h1>
            </div>
            <div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Exam</th>
                                <th scope="col">Name</th>
                                <th scope="col">Amount ($)</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $k => $order_item)
                            <tr>
                                <th scope="row">{{ $k+1 }}</th>
                                <td>{{ $order_item->certification->title }}</td>
                                <td>
                                    <p class="mb-0">{{ $order_item->order->user->name }}</p>
                                    <span class="text-muted">{{ $order_item->order->user->email }}</span>
                                </td>
                                <td>{{ $order_item->price }}</td>
                                <td>
                                    @if ($order_item->order->status == 'pending')
                                    <span class="label text-info bg-light-info text-capitalize" title="Remove from menu list">{{ $order_item->order->status }}</span>
                                    @elseif ($order_item->order->status == 'success')
                                    <span class="label text-success bg-light-success text-capitalize" title="Remove from menu list">{{ $order_item->order->status }}</span>
                                    @elseif ($order_item->order->status == 'danger')
                                    <span class="label text-danger bg-light-danger text-capitalize" title="Remove from menu list">{{ $order_item->order->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $orders->links('components.pagination-links') }}
                </div>
            </div>
        </div>
    </div>
</div>
