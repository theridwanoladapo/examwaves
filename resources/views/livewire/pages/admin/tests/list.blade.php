<?php

use App\Models\Test;
use function Livewire\Volt\{state};

$getTests = fn () => $this->tests = Test::all();

state(['tests' => $getTests]);

$deleteTest = function (Test $test) {
    $test->delete();

    $this->getTests();
}

?>

<div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->tests as $k => $test)
                <tr>
                    <th scope="row">{{ $k+1 }}</th>
                    <td>{{ $test->name }}</td>
                    <td>{{ $test->time_limit }}</td>
                    <td>
                        <a href="{{ route('admin.tests.view', $test->id) }}" class="square--30 circle text-light bg-seegreen d-inline-flex">
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
    </div>
</div>
