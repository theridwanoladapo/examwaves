<?php

use App\Models\OrderItem;
use App\Models\User;

use function Livewire\Volt\{state, on, with, usesPagination};

$getUser = fn () => $this->user = User::find($this->user_id);

state(['user_id', 'user' => $getUser]);

on(['updateStatus' => function () {
    $this->user = User::find($this->user_id);
}]);

usesPagination(theme: 'bootstrap');

with(fn () => [
    'items' => OrderItem::whereHas('order', function ($query) {
        $query->where('user_id', $this->user_id);
    })->where('isActive', 1)->paginate(10)
]);

$unactivateUser = function (User $user) {
    $user->update([
        'isActive' => false
    ]);

    $this->dispatch('updateStatus');
    $this->resetPage();

    session()->flash('success', 'User account inactivated successfully!');
};

$activateUser = function (User $user) {
    $user->update([
        'isActive' => true
    ]);

    $this->dispatch('updateStatus');
    $this->resetPage();

    session()->flash('success', 'User account activated successfully!');
};

?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('success')" />

    <div class="dash-wrapsw card py-0 px-lg-5 px-4 pb-4 border-0 rounded-4 mb-4">
        <div class="position-absolute start-0 end-0 top-0 bg-primary ht-120"></div>
        <div class="position-absolute end-0 top-0 mt-5 pt-3 me-4 z-1">
            @if ($user->isActive)
            <button type="button" wire:click="unactivateUser({{$user->id}})" class="btn btn-sm btn-danger fw-medium">Suspend User</button>
            @else
            <button type="button" wire:click="activateUser({{$user->id}})" class="btn btn-sm btn-success fw-medium">Unsuspend User</button>
            @endif
        </div>
        <div class="dash-y44 position-relative mb-3">
            <div class="dash-user-thumb mt-5 pt-2">
                <img src="{{ asset('assets/img/user-img.png') }}" class="img-fluid circle border border-3" width="100" alt="User">
            </div>
            <div class="dash-y45 row align-items-center justify-content-between gy-3">
                <div class="lios-parts-starts col-sm-7">
                    <h5 class="m-0">{{ $user->name }}</h5>
                    <p class="m-0 text-muted">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <!--  -->
        <div class="dash-y45">
            <ul class="no-ul-list row g-4">
                <li class="col-sm-4">
                    <p class="text-muted mb-0">Firstname</p>
                    <p class="m-0 text-dark fw-medium">{{ $user->profile->firstname ?? 'Nil' }}</p>
                </li>
                <li class="col-sm-4">
                    <p class="text-muted mb-0">Lastname</p>
                    <p class="m-0 text-dark fw-medium">{{ $user->profile->lastname ?? 'Nil' }}</p>
                </li>
                <li class="col-sm-5">
                    <p class="text-muted mb-0">Headline</p>
                    <p class="m-0 text-dark fw-medium">{{ $user->profile->headline ?? 'Nil' }}</p>
                </li>
                <li class="col-sm-10">
                    <p class="text-muted mb-0">Biography</p>
                    <p class="m-0 text-dark fw-medium">{{ $user->profile->biography ?? 'Nil' }}</p>
                </li>
            </ul>
        </div>

    </div>

    <div class="dash-wrapsw card border-0 rounded-4">
        <div class="card-header">
            <h6>My Exams</h6>
        </div>
        <div class="card-body">
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
                            <td>{{ $item->certification->title }}
                                {{ $item->certification->code ? '('.$item->certification->code.')' : null }}
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
    </div>
</div>