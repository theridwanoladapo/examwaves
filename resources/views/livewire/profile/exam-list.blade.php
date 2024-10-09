<?php

use App\Models\OrderItem;

use function Livewire\Volt\{state, with, usesPagination};

state(['user_id' => auth()->user()->id]);

usesPagination(theme: 'bootstrap');

with(fn () => [
    'items' => OrderItem::whereHas('order', function ($query) {
        $query->where('user_id', $this->user_id);
    })->where('isActive', 1)->paginate(10)
]);

?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('success')" />

    @if ($items)
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Exam</th>
                    <th scope="col">Exam Provider</th>
                    <th scope="col">No. of Test</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $k => $item)
                <tr>
                    <th>{{ $k+1 }}</th>
                    <td>
                        <a class="font--bold " href="{{ route('exam', $item->certification->id) }}" wire:navigate>
                            {{ $item->certification->title }} ({{ $item->certification->code }})
                        </a>
                    </td>
                    <td>{{ $item->certification->exam->name }}</td>
                    <td>{{ exam_test_count($item->certification->id) }}</td>
                    <td>
                        @if ($item->isActive)
                        <span class="label text-success bg-light-success">Active</span>
                        @else
                        <span class="label text-danger bg-light-danger">Not Active</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('exam', $item->certification->id) }}" class="square--30 circle text-light bg-seegreen d-inline-flex" wire:navigate>
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $items->links('components.pagination-links') }}
    </div>
    @else
    <div class="d-flex align-items-center justify-content-center py-5 border rounded bg-white">
        <span class="fs-xl font--bold">You have no exams</span>
    </div>
    @endif
</div>
