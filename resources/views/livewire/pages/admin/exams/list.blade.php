<?php

use App\Models\Exam;

use function Livewire\Volt\{with, usesPagination};

usesPagination(theme: 'bootstrap');

with(fn () => ['exams' => Exam::paginate(10)]);

$deleteExam = function (Exam $exam) {
    $exam->delete();

    $this->resetPage();

    session()->flash('success', 'Exam Provider has been deleted successfully!');
};

$addToMenu = function (Exam $exam) {
    $exam->update([
        'isMenu' => true
    ]);

    $this->resetPage();

    session()->flash('success', 'Exam Provider has been added to menu successfully!');
};

$removeFromMenu = function (Exam $exam) {
    $exam->update([
        'isMenu' => false
    ]);

    $this->resetPage();

    session()->flash('success', 'Exam Provider has been removed from menu successfully!');
};

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
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exams as $k => $exam)
                <tr>
                    <th scope="row">{{ $k+1 }}</th>
                    <td>{{ $exam->name }}</td>
                    <td>
                        @if ($exam->isMenu)
                        <span wire:click="removeFromMenu({{$exam->id}})"
                        wire:confirm="Are you sure you want to remove {{ $exam->name }} from menu list?"
                        class="label text-success bg-light-success" title="Remove from menu list">On menu list</span>
                        @else
                        <span wire:click="addToMenu({{$exam->id}})"
                        wire:confirm="Are you sure you want to add {{ $exam->name }} to menu list?"
                        class="label text-info bg-light-info cursor-pointer" title="Add to menu list">Add to menu list</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.exams.view', $exam->id) }}" class="square--30 circle text-light bg-seegreen d-inline-flex">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <button wire:click="deleteExam({{$exam->id}})" wire:confirm="Are you sure you want to delete {{ $exam->name }}?" class="square--30 circle text-light bg-danger d-inline-flex ms-2">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $exams->links('components.pagination-links') }}
    </div>
</div>
