<?php

use App\Models\Exam;

use function Livewire\Volt\{with, usesPagination};

usesPagination(theme: 'bootstrap');

with(fn () => ['exams' => Exam::paginate(10)]);

$deleteExam = function (Exam $exam) {
    $exam->delete();

    $this->resetPage();
}

?>

<div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    {{-- <th scope="col">Description</th> --}}
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exams as $k => $exam)
                <tr>
                    <th scope="row">{{ $k+1 }}</th>
                    <td>{{ $exam->name }}</td>
                    {{-- <td>{!! Str::limit($exam->description, 120) !!}</td> --}}
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
