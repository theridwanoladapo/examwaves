<?php
use App\Models\Question;

use function Livewire\Volt\{state, mount, on};

// $getQuestions = fn () => $this->questions = Question::where('answer_type', 'multi_opt')->get();
$getQuestions = fn () => $this->questions = Question::where('test_id', $this->test->id)->get();
// $getQuizzes = fn () => $this->quizzes = Question::select('id','correct_options', 'answer_type')->where('answer_type', 'multi_opt')->get();
$getQuizzes = fn () => $this->quizzes = Question::select('id','correct_options', 'answer_type')->where('test_id', $this->test->id)->get();

state([
    'test',
    'questions' => $getQuestions,
    'quizzes' => $getQuizzes,
    'quiz' => [],
    'currentQuestionIndex' => 0,
    'selectedAnswer' => null,
    'selectedAnswers' => [],
    'score' => 0,
    'isStarted' => false,
    'isFinished' => false,
    'isSubmitted' => false,
    'review',
    'timeLeft' => null,
]);

mount(function () {
    // $this->timeLeft = $this->test->time_limit; // Set the quiz time
    foreach ($this->quizzes as $key => $question) {
        if ($question->answer_type == "multi_opt") {
            $this->quiz[$question->id] = ['answer' => []];
            $this->quiz[$question->id] = ['correct' => explode(',', $question->correct_options)];
        } else {
            $this->quiz[$question->id] = ['answer' => null];
            $this->quiz[$question->id] = ['correct' => $question->correct_options];
        }
    }

});

on(['decrementTimer' => function () {
    if ($this->timeLeft > 0 && !$this->isFinished) {
        $this->timeLeft--;
    } else {
        $this->finishQuiz(); // Finish quiz when time runs out
    }
}]);

$updateScore = function ()
{
    if ($this->questions[$this->currentQuestionIndex]->answer_type == "multi_opt") {
        $question_id = $this->questions[$this->currentQuestionIndex]->id;

        $this->quiz[$question_id]['answer'] = $this->selectedAnswers;

        // if ($this->selectedAnswers == $this->quiz[$question_id]['correct']) {
        //     $this->score++;
        // }
    } else {
        $question_id = $this->questions[$this->currentQuestionIndex]->id;

        $this->quiz[$question_id]['answer'] = $this->selectedAnswer;

        // if ($this->selectedAnswer == $this->quiz[$question_id]['correct']) {
        //     $this->score++;
        // }
    }
};

$startQuiz = function ()
{
    $this->isStarted = true;
    $this->timeLeft = $this->test->time_limit*60; // Set the quiz time
    $this->dispatch('startTimer'); // Start the timer
};

$finishQuiz = function ()
{
    $this->updateScore();

    $this->isFinished = true;
};

// Navigate to the next question
$nextQuestion = function ()
{
    $this->updateScore();

    $this->currentQuestionIndex++;

    $this->selectedAnswer = $this->quiz[$this->questions[$this->currentQuestionIndex]->id]['answer'] ?? null;
    $this->selectedAnswers = $this->quiz[$this->questions[$this->currentQuestionIndex]->id]['answer'] ?? [];

    // Move to the next question if not the last one
    if ($this->currentQuestionIndex + 1 > count($this->questions)) {
        $this->isFinished = true;
    }
};

// Navigate to the previous question
$previousQuestion = function ()
{
    $this->updateScore();

    $this->currentQuestionIndex--;

    $this->selectedAnswer = $this->quiz[$this->questions[$this->currentQuestionIndex]->id]['answer'] ?? null;
    $this->selectedAnswers = $this->quiz[$this->questions[$this->currentQuestionIndex]->id]['answer'] ?? [];
};

$cancelSubmit = function ()
{
    $this->selectedAnswer = $this->quiz[$this->questions[$this->currentQuestionIndex]->id]['answer'] ?? null;
    $this->selectedAnswers = $this->quiz[$this->questions[$this->currentQuestionIndex]->id]['answer'] ?? [];

    $this->isFinished = false;
};

$submitQuiz = function ()
{
    $val = [];
    $score = 0;
    $correct_ans = [];
    $wrong_ans = [];
    $skipped_ans = [];

    foreach ($this->quiz as $k => $val) {
        if (!isset($val['answer']) || is_null($val['answer']) || empty($val['answer'])) {
            $skipped_ans[$k] = $val;
        } else {
            if ($val['correct'] === $val['answer']) {
                $score += 1;
                $correct_ans[$k] = $val;
            } else {
                $wrong_ans[$k] = $val;
            }
        }
    }
    $score_percent = score_percent($this->test->id, $score);
    $status = ($score_percent >= $this->test->pass_percent) ? 'passed' : 'failed';

    $data = [
        'test_id' => $this->test->id,
        'user_id' => auth()->user()->id,
        'score' => $score,
        'status' => $status,
        'correct_ans' => $correct_ans,
        'wrong_ans' => $wrong_ans,
        'skipped_ans' => $skipped_ans,
        'time_spent' => ($this->test->time_limit*60 - $this->timeLeft),
    ];

    $this->review = $data;

    $this->isSubmitted = true;
}

?>

<div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="row">
            <div class="col-md-9">
                <div class="ps-md-4 ps-lg-3 overflow-y-auto border border-3" style="height: 450px">

                    @if ($isStarted)

                    @if (!$isSubmitted)
                    <form wire:submit.prevent="submitQuiz">
                        {{-- Quiz Tab --}}
                        <div class="card card-primary">
                            @if (!$isFinished)
                            <div class="card-header">
                                <div class="w-100">
                                    <div class="d-flex justify-content-start">
                                        <button type="button" wire:click="previousQuestion" {{ $currentQuestionIndex == 0 ? 'disabled' : '' }}
                                        class="btn btn-sm btn-outline-dark px-3">Back</button>
                                    </div>
                                </div>
                                <div class="w-100">
                                    <div class="d-flex justify-content-end">
                                        @if ($this->currentQuestionIndex + 1 == count($this->questions))
                                        <button type="button" wire:click="finishQuiz" class="btn btn-sm btn-primary px-3">
                                            Finish Exam
                                        </button>
                                        @else
                                        <button type="button" wire:click="nextQuestion" class="btn btn-sm btn-primary px-3">
                                            Next
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="card-body">
                                @if (!$isFinished)
                                <span class="pt-2 pt-sm-3 pt-md-4 pt-lg-5">Question {{ $currentQuestionIndex + 1 }} of {{ count($questions) }}:</span>
                                <h6 class="mt-2">{!! $questions[$currentQuestionIndex]->question !!}</h6>

                                @php
                                    $options = [ 'a' => 'option_a', 'b' => 'option_b', 'c' => 'option_c', 'd' => 'option_d', 'e' => 'option_e', 'f' => 'option_f', 'g' => 'option_g'];
                                @endphp

                                @if ($questions[$currentQuestionIndex]->answer_type == "multi_opt")
                                <div class="pt-4">
                                    @foreach ($options as $k => $option)
                                    @if ($questions[$currentQuestionIndex]->$option)
                                        <div class="form-check ps-0">
                                            <label for="option-{{$k}}" class="form-check-label border rounded py-2 w-100 d-flex align-items-start">
                                                <div class="ms-2 form-check">
                                                    <input wire:model="selectedAnswers" type="checkbox" value="{{$k}}" id="option-{{$k}}" class="form-check-input">
                                                </div>
                                                <div class="ms-2">
                                                    {!! $questions[$currentQuestionIndex]->$option !!}
                                                </div>
                                            </label>
                                        </div>
                                    @endif
                                    @endforeach
                                </div>
                                @endif

                                @if ($questions[$currentQuestionIndex]->answer_type == "one_opt")
                                <div class="pt-4">
                                    @foreach ($options as $k => $option)
                                    @if ($questions[$currentQuestionIndex]->$option)
                                    <div class="form-check ps-0">
                                        <label class="form-check-label border rounded py-2 w-100 d-flex align-items-center">
                                            <div class="ms-2 form-check">
                                                <input wire:model="selectedAnswer" name="selectedAnswer" value="{{$k}}" type="radio" class="form-check-input">
                                            </div>
                                            <span class="ms-3">
                                                {!! $questions[$currentQuestionIndex]->$option !!}
                                            </span>
                                        </label>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                @endif

                                @else
                                <div class="w-100 d-flex flex-column justify-content-start">
                                    <h2>Finish Exam</h2>
                                    <div>
                                        <p class="mb-3">Are you sure you want to submit the exam?</p>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-success px-4">
                                            Submit Exam
                                        </button>
                                        <button type="button" wire:click="cancelSubmit" class="btn btn-outline-dark px-4">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                                @endif
                            </div>

                            @if (!$isFinished)
                            <div class="card-footer">
                                <div class="w-100">
                                    <div class="d-flex justify-content-between">
                                        <button type="button" wire:click="previousQuestion" {{ $currentQuestionIndex == 0 ? 'disabled' : '' }}
                                        class="btn btn-sm btn-outline-dark px-3">Back</button>
                                        @if ($this->currentQuestionIndex + 1 == count($this->questions))
                                        <button type="button" wire:click="finishQuiz" class="btn btn-sm btn-primary px-3">
                                            Finish Exam
                                        </button>
                                        @else
                                        <button type="button" wire:click="nextQuestion" class="btn btn-sm btn-primary px-3">
                                            Next
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </form>
                    @else
                    {{-- Review Tab --}}
                    <div class="card-body px-5 py-4">
                        <h4>{{ $test->certification->title }} {{ $test->name }} - Results</h4>
                        <!-- Single Order -->
                        <div class="card h-100 rounded-4 border p-3 p-sm-4">
                            <div class="d-flex align-items-center justify-content-between pb-2 mb-1">
                                <h3 class="fw-bold {{ $review['status'] == 'passed' ? 'text-success' : 'text-danger' }} text-capitalize mb-0">
                                    {{ $review['status'] }}</h3>
                                <h4 class="h5 ms-auto mb-0">{{ score_percent($this->test->id, $review['score']) }}% correct</h4>
                                <div class="d-flex ms-auto">
                                    <button type="button" class="btn btn-outline-dark" >
                                        Review Questions
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex align-items-center pb-2 mb-1">
                                <p class="fw-bold text-success mb-0">{{ count($review['correct_ans']) }} Correct</p>
                                <p class="fw-bold text-danger ms-3 mb-0">{{ count($review['wrong_ans']) }} Wrong</p>
                                <p class="fw-bold text-dark ms-3 mb-0">{{ count($review['skipped_ans']) }} Skipped/Unanswered</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @else
                    {{-- Welcome tab --}}
                    <div class="card card-body">
                        <div style="height: 100%" class="w-100 d-flex flex-column justify-content-start">
                            <h2 class="mt-3">Welcome to the Quiz!</h2>
                            <div>
                                <p>Press the button below to start the quiz. You will have {{ $this->test->time_limit }} minutes to complete it.</p>
                            </div>
                            <div class="mt-3">
                                <button type="button" wire:click="startQuiz" class="btn btn-primary px-4">
                                    Start Exam
                                </button>
                            </div>
                        </div>
                    </div>

                    @endif

                </div>
            </div>

            <div class="col-md-3">
                <div class="d-flex d-md-block flex-wrap position-sticky top-0 border border-3 p-2">
                    <div class="card card-primary">
                        <div class="card-body">
                            @if ($isStarted || !$isSubmitted)
                            <span>{{ $currentQuestionIndex + 1 }}/{{ count($questions) }}</span>
                            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="{{ $currentQuestionIndex + 1 }}" aria-valuemin="1" aria-valuemax="{{ count($questions) }}">
                                <div class="progress-bar" style="width: {{ ($currentQuestionIndex + 1) / count($questions) * 100  }}%"></div>
                            </div>
                            <div class="text-left mb-3">
                                <h5 class="text-primary">Timer:
                                    <span class="bg-light py-2 px-3 rounded w-100">
                                        {{ $timeLeft ? gmdate('H:i:s', $timeLeft) : null }}
                                    </span>
                                </h5>
                            </div>
                            @endif
                            @if ($isStarted)
                            <div class="mt-3">
                                <button wire:click="finishQuiz" type="button" class="btn btn-outline-success w-100" id="submit">Finish Exam</button>
                            </div>
                            @else
                            <div>
                                <button wire:click="startQuiz" type="button" class="btn btn-primary w-100" id="submit">Start Exam</button>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@script
<!-- Timer script to decrement every second -->
<script>
    document.addEventListener('livewire:initialized', function () {
        // Listen for the startTimer event to start the countdown
        Livewire.on('startTimer', function () {
            setInterval(() => {
                Livewire.dispatch('decrementTimer');
            }, 1000);  // Decrement every 1 second
        });
    });
</script>
@endscript
