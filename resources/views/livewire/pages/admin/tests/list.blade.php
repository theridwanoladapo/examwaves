<?php

use App\Models\Test;

use function Livewire\Volt\{with, usesPagination};

usesPagination(theme: 'bootstrap');

with(fn () => ['tests' => Test::paginate(10)]);

$deleteTest = function (Test $test) {
    $test->delete();

    $this->resetPage();

    session()->flash('success', 'Test has been deleted successfully!');
}

?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('success')" />

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Certification</th>
                    <th scope="col">Time (in mins)</th>
                    <th scope="col">Pass Score (%)</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tests as $k => $test)
                <tr>
                    <th scope="row">{{ $k+1 }}</th>
                    <td>{{ $test->name }}</td>
                    <td>{{ $test->certification->title }}</td>
                    <td>{{ $test->time_limit }}</td>
                    <td>{{ $test->pass_percent }}</td>
                    <td>
                        <a href="{{ route('admin.tests.view', $test->id) }}" class="square--30 circle text-light bg-seegreen d-inline-flex ms-2 mb-1">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <button wire:click="deleteTest({{$test->id}})" wire:confirm="Are you sure you want to delete {{ $test->name }}?" class="square--30 circle text-light bg-danger d-inline-flex ms-2">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $tests->links('components.pagination-links') }}
    </div>
</div>
