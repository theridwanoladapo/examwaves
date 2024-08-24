<?php

use App\Models\Question;

use function Livewire\Volt\{state};

$getQuestions = fn () => $this->questions = Question::where('test_id', $this->test_id)->get();

state(['test_id', 'questions' => $getQuestions]);

$deleteQuestion = function (Question $question) {
    $question->delete();

    $this->getQuestions();
}

?>

<div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Question</th>
                    <th scope="col">Answer Type</th>
                    <th scope="col">Test</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->questions as $k => $question)
                <tr>
                    <th>{{ $k+1 }}</th>
                    <td>{{ $question->question }}</td>
                    <td>{{ answer_type_human($question->answer_type) }}</td>
                    <td><strong>{{ $question->test->name }}</strong></td>
                    <td>
                        {{-- <a href="{{ route('admin.questions.view', $question->id) }}" class="square--30 circle text-light bg-seegreen d-inline-flex">
                            <i class="fa-solid fa-eye"></i>
                        </a> --}}
                        <button wire:click="deleteQuestion({{$question->id}})" wire:confirm="Are you sure you want to delete this question?" class="square--30 circle text-light bg-danger d-inline-flex ms-2">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
