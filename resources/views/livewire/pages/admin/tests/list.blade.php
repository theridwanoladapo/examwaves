<?php

use App\Models\Test;

use function Livewire\Volt\{with, usesPagination, state, computed};

state(['search'])->url();
state(['sortField' => 'tests.name'])->url();
state(['sortDirection' => 'asc'])->url();

$tests = computed(function () {
    $query = Test::query();

    if ($search = $this->search) {
        $query->with('certification')
            ->where(function ($que) {
                $que->where('tests.name', 'like', "%{$this->search}%")
                    ->orWhereHas('certification', function ($q) {
                        $q->where('title', 'like', "%{$this->search}%");
                    });
            })
            ->join('certifications', 'certifications.id', '=', 'tests.certification_id')
            ->orderBy($this->sortField, $this->sortDirection);
    }

    return $query;
});

$sortBy = function ($field) {
    $this->resetPage();

    if ($this->sortField === $field) {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    } else {
        $this->sortField = $field;
        $this->sortDirection = 'asc';
    }
};

usesPagination(theme: 'bootstrap');

with(fn () => ['tests' => $this->tests->paginate(10)]);

$deleteTest = function (Test $test) {
    $test->delete();

    $this->resetPage();

    session()->flash('success', 'Test has been deleted successfully!');
}

?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('success')" />

    <div class="col-md-6">
        <input type="text" wire:model.live="search" class="form-control" placeholder="Search exams or certifications...">
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">
                        <a href="javascript:void(0)" wire:click.prevent="sortBy('tests.name')">
                            Name
                            @if($sortField == 'tests.name')
                                <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                            @endif
                        </a>
                    </th>
                    <th scope="col">
                        Certification
                        {{-- <a href="javascript:void(0)" wire:click.prevent="sortBy('certification_title')">
                            @if($sortField == 'certification_title')
                                <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                            @endif
                        </a> --}}
                    </th>
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
                    <td>{{ $test->certification->title }}
                        {{ $test->certification->code ? '('.$test->certification->code.')' : null }}
                    </td>
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
