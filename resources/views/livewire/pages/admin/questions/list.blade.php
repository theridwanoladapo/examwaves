<?php

use App\Models\Question;

use function Livewire\Volt\{state, with, usesPagination};

usesPagination(theme: 'bootstrap');

with(fn () => ['questions' => Question::where('test_id', $this->test_id)->paginate(10)]);

state(['test_id']);

$deleteQuestion = function (Question $question) {
    $question->delete();

    $this->resetPage();

    session()->flash('success', 'Question has been deleted successfully!');
}

?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="h6 mb-4" :status="session('success')" />

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Question</th>
                    <th scope="col">Answer Type</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $k => $question)
                <tr>
                    <th>{{ $k+1 }}</th>
                    <td>{!! $question->question !!}</td>
                    <td>{{ answer_type_human($question->answer_type) }}</td>
                    <td>
                        <a href="{{ route('admin.questions.edit', $question->id) }}" class="square--30 circle text-light bg-primary d-inline-flex ms-2 mb-1">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <button wire:click="deleteQuestion({{$question->id}})" wire:confirm="Are you sure you want to delete this question?" class="square--30 circle text-light bg-danger d-inline-flex ms-2">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $questions->links('components.pagination-links') }}
    </div>
</div>
