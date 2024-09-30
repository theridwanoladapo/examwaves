<?php
use App\Models\Question;
use App\Models\TestAttempt;

use function Livewire\Volt\{state, mount, on};

$getQuestions = fn () => $this->questions = Question::where('test_id', $this->test->id)->get();
$getQuizzes = fn () => $this->quizzes = Question::select('id','correct_options', 'answer_type')->where('test_id', $this->test->id)->get();

state([
    'user_id' => auth()->user()->id,
    'test',
    'attempts',
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
    'review' => [],
    'onReview' => false,
    'timeLeft' => null,
]);

mount(function () {
    $this->attempts = $this->getAttempts();

    foreach ($this->quizzes as $key => $question) {
        $correct_options = Str::lower($question->correct_options);

        if ($question->answer_type == "multi_opt") {
            $this->quiz[$question->id]['answer'] = [];
            $this->quiz[$question->id]['correct'] = explode(',', $correct_options);
        } else {
            $this->quiz[$question->id]['answer'] = null;
            $this->quiz[$question->id]['correct'] = $correct_options;
        }
    }
});

// decrement timer
on(['decrementTimer' => function () {
    if ($this->timeLeft > 0 && !$this->isFinished) {
        $this->timeLeft--;
    } else {
        $this->finishQuiz(); // Finish quiz when time runs out
    }
}]);

// update chosen answer
$updateAnswer = function ()
{
    // check if question's answer type is multiple or one
    // and assign accordingly
    if ($this->questions[$this->currentQuestionIndex]->answer_type == "multi_opt") {
        $question_id = $this->questions[$this->currentQuestionIndex]->id;

        $this->quiz[$question_id]['answer'] = $this->selectedAnswers;
    } else {
        $question_id = $this->questions[$this->currentQuestionIndex]->id;

        $this->quiz[$question_id]['answer'] = $this->selectedAnswer;
    }
};

// Start quiz
$startQuiz = function ()
{
    $this->isStarted = true;
    $this->timeLeft = $this->test->time_limit*60; // Set the quiz time
    $this->dispatch('startTimer'); // Start the timer
};

// Finish quiz
$finishQuiz = function ()
{
    $this->updateAnswer();

    $this->isFinished = true;
};

// Navigate to the next question
$nextQuestion = function ()
{
    $this->updateAnswer();

    // Check if it's last question and finishQuiz
    if ($this->currentQuestionIndex + 1 > count($this->questions)) {
        $this->isFinished = true;
    } else {    // Move to the next question if not the last one
        $this->currentQuestionIndex++;

        $this->selectedAnswer = $this->quiz[$this->questions[$this->currentQuestionIndex]->id]['answer'] ?? null;
        $this->selectedAnswers = $this->quiz[$this->questions[$this->currentQuestionIndex]->id]['answer'] ?? [];
    }
};

// Navigate to the previous question
$previousQuestion = function ()
{
    $this->updateAnswer();

    if ($this->currentQuestionIndex > 0) {
        $this->currentQuestionIndex--;

        $this->selectedAnswer = $this->quiz[$this->questions[$this->currentQuestionIndex]->id]['answer'] ?? null;
        $this->selectedAnswers = $this->quiz[$this->questions[$this->currentQuestionIndex]->id]['answer'] ?? [];
    }
};

$cancelSubmit = function ()
{
    $this->selectedAnswer = $this->quiz[$this->questions[$this->currentQuestionIndex]->id]['answer'] ?? null;
    $this->selectedAnswers = $this->quiz[$this->questions[$this->currentQuestionIndex]->id]['answer'] ?? [];

    $this->isFinished = false;
};

$returnToAttempts = function () {
    $this->onReview = false;

    $this->review = [];
};

$reviewAttempt = function ($id) {
    $attempt = TestAttempt::find($id);
    $correct_ans = json_decode($attempt->correct_ans, true);
    $wrong_ans = json_decode($attempt->wrong_ans, true);
    $skipped_ans = json_decode($attempt->skipped_ans, true);

    foreach ($this->quizzes as $key => $question) {
        $correct_options = Str::lower($question->correct_options);

        if ($question->answer_type == "multi_opt") {
            if (array_key_exists($question->id, $correct_ans)) {
                $this->review[$question->id]['answer'] = $correct_ans[$question->id]['answer'];
            } elseif (array_key_exists($question->id, $wrong_ans)) {
                $this->review[$question->id]['answer'] = $wrong_ans[$question->id]['answer'];
            } else {
                $this->review[$question->id]['answer'] = [];
            }
            $this->review[$question->id]['correct'] = explode(',', $correct_options);
        } else {
            if (array_key_exists($question->id, $correct_ans)) {
                $this->review[$question->id]['answer'] = $correct_ans[$question->id]['answer'];
            } elseif (array_key_exists($question->id, $wrong_ans)) {
                $this->review[$question->id]['answer'] = $wrong_ans[$question->id]['answer'];
            } else {
                $this->review[$question->id]['answer'] = null;
            }
            $this->review[$question->id]['correct'] = $correct_options;
        }
    }

    // dd($this->review);
    $this->onReview = true;
};

// Get attempts
$getAttempts = function () {
    $attempts =  TestAttempt::where('user_id', $this->user_id)
        ->where('test_id', $this->test->id)
        ->latest('id')->get();

    return $attempts;
};

// Submit Quiz
$submitQuiz = function ()
{
    $val = [];
    $score = 0;
    $correct_ans = [];
    $wrong_ans = [];
    $skipped_ans = [];

    // check answer for questions
    // and record score
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
        'correct_ans' => json_encode($correct_ans),
        'wrong_ans' => json_encode($wrong_ans),
        'skipped_ans' => json_encode($skipped_ans),
        'time_spent' => ($this->test->time_limit*60 - $this->timeLeft),
    ];

    // submit quiz in database
    TestAttempt::create($data);

    // assign data to review
    $this->attempts = $this->getAttempts();

    $this->isSubmitted = true;
};


?>

<div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="row">
            <div class="col-md-9">
                <div class="ps-md-4 ps-lg-3 overflow-y-auto border border-3 rounded" style="height: 450px">

                    @if ($onReview)
                    {{-- Questions Review --}}
                    <div class="card-body px-4 py-4">
                        <h5>{{ $test->certification->title }} {{ $test->name }} - Results Review</h5>
                        <hr>
                        @if ($isSubmitted)
                        <button wire:click="returnToAttempts" type="button" class="btn btn-sm btn-light mb-3">
                            <i class="fas fa-chevron-left me-2"></i> Back to Result Overview
                        </button>
                        @else
                        <button wire:click="returnToAttempts" type="button" class="btn btn-sm btn-light mb-3">
                            <i class="fas fa-chevron-left me-2"></i> Go Back
                        </button>
                        @endif

                        <div class="accordion" id="accordionExample" wire:ignore>
                            @foreach ($questions as $key => $question)
                            <div class="accordion-item border rounded mb-4">
                                <h2 class="accordion-header" id="heading{{$key+1}}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{$key+1}}" aria-expanded="false" aria-controls="collapse{{$key+1}}">
                                        <div>
                                            <h5 class="text-dark fw-semibold h6 mb-3">
                                                @if (!isset($review[$question->id]['answer']) || is_null($review[$question->id]['answer']) || empty($review[$question->id]['answer']))
                                                    <i class="fa fa-circle text-muted"></i>
                                                @else
                                                    @if ($review[$question->id]['correct'] === $review[$question->id]['answer'])
                                                    <i class="fa fa-circle-check text-success"></i>
                                                    @else
                                                    <i class="fa fa-circle-exclamation text-danger"></i>
                                                    @endif
                                                @endif
                                                Question {{ $key + 1 }}
                                                @if (!isset($review[$question->id]['answer']) || is_null($review[$question->id]['answer']) || empty($review[$question->id]['answer']))
                                                    <span class="text-muted fw-medium h6 ms-3 mb-1">Skipped</span>
                                                @else
                                                    @if ($review[$question->id]['correct'] === $review[$question->id]['answer'])
                                                    <span class="text-success fw-medium h6 ms-3 mb-1">Correct</span>
                                                    @else
                                                    <span class="text-danger fw-medium h6 ms-3 mb-1">Wrong</span>
                                                    @endif
                                                @endif
                                            </h5>
                                            <p class="m-0">
                                                {!! $question->question !!}
                                            </p>
                                        </div>
                                    </button>
                                </h2>

                                <div id="collapse{{$key+1}}" class="accordion-collapse collapse" aria-labelledby="heading{{$key+1}}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        @php
                                            $options = [ 'a' => 'option_a', 'b' => 'option_b', 'c' => 'option_c', 'd' => 'option_d', 'e' => 'option_e', 'f' => 'option_f', 'g' => 'option_g'];
                                        @endphp
                                        {{-- Multiple answer type --}}
                                        @if ($question->answer_type == "multi_opt")
                                            @foreach ($options as $k => $option)
                                                @if (!is_null($question->$option) || $question->$option != "")
                                                @php
                                                    $status = '#000';
                                                    if (isset($review[$question->id]['answer'])) {
                                                        if (in_array($k, $review[$question->id]['correct'])
                                                            || in_array($k, $review[$question->id]['answer'])) {
                                                            $status = '#00ba74';
                                                        }
                                                        if (!in_array($k, $review[$question->id]['correct'])
                                                            && in_array($k, $review[$question->id]['answer'])) {
                                                            $status = '#dc3545';
                                                        }
                                                    } elseif (in_array($k, $review[$question->id]['correct'])) {
                                                        $status = '#00ba74';
                                                    }
                                                @endphp
                                                <div class="mt-3 rounded py-3 px-3 w-100" style="border: 1px solid {{$status}};">
                                                    @if (isset($review[$question->id]['answer']))
                                                        @if (in_array($k, $review[$question->id]['correct']) || (in_array($k, $review[$question->id]['correct']) && in_array($k, $review[$question->id]['answer'])))
                                                            <span class="badge bg-light-success text-success p-1 mb-2">Correct answer</span>
                                                        @elseif (!in_array($k, $review[$question->id]['correct']) && in_array($k, $review[$question->id]['answer']))
                                                            <span class="badge bg-light-danger text-danger p-1 mb-2">Your answer is incorrect</span>
                                                        @endif
                                                    @elseif (in_array($k, $review[$question->id]['correct']))
                                                        <span class="badge bg-light-success text-success p-1 mb-2">Correct answer</span>
                                                    @endif
                                                    <div class="d-flex align-items-start">
                                                        @if (isset($review[$question->id]['answer']))
                                                            @if (in_array($k, $review[$question->id]['correct']) || (in_array($k, $review[$question->id]['correct']) && in_array($k, $review[$question->id]['answer'])))
                                                            <i class="fas fa-square-check text-success pe-3 py-1"></i>
                                                            @elseif (!in_array($k, $review[$question->id]['correct']) && in_array($k, $review[$question->id]['answer']))
                                                            <i class="fas fa-square-xmark text-danger pe-3 py-1"></i>
                                                            @else
                                                            <i class="far fa-square text-dark pe-3 py-1"></i>
                                                            @endif
                                                        @elseif (in_array($k, $review[$question->id]['correct']))
                                                        <i class="fas fa-square-check text-success pe-3 py-1"></i>
                                                        @endif
                                                        <h6 class="ms-1 fw-semibold mb-0" style="color: {{$status}}">
                                                            {!! $question->$option !!}
                                                        </h6>
                                                    </div>
                                                </div>
                                                @endif
                                            @endforeach
                                            <div class="mt-5 rounded py-4 px-3 w-100" style="border: 1px solid #000;">
                                                <h6 class="fw-bold">Overall Explanation</h6>
                                                <div class="mb-1">
                                                    <span class="h6 text-dark fw-bold">Correct Answer:</span>
                                                    {{ Str::upper(implode(', ', $review[$question->id]['correct'])) }}.
                                                </div>
                                                <div class="mb-0">{!! $question->explanation !!}</div>
                                            </div>
                                        @endif
                                        {{-- One answer type --}}
                                        @if ($question->answer_type == "one_opt")
                                            @foreach ($options as $k => $option)
                                                @if (!is_null($question->$option) || $question->$option != "")
                                                @php
                                                    $correct_option = 'option_'.$review[$question->id]['correct'];
                                                    $status = '#000';
                                                    if (isset($review[$question->id]['answer'])) {
                                                        if ($k === $review[$question->id]['correct']
                                                            || $k === $review[$question->id]['answer']) {
                                                            $status = '#00ba74';
                                                        }
                                                        if ($k !== $review[$question->id]['correct']
                                                            && $k === $review[$question->id]['answer']) {
                                                            $status = '#dc3545';
                                                        }
                                                    } elseif ($k === $review[$question->id]['correct']) {
                                                        $status = '#00ba74';
                                                    }
                                                @endphp
                                                <div class="mt-3 rounded py-3 px-3 w-100" style="border: 1px solid {{$status}};">
                                                    @if (isset($review[$question->id]['answer']))
                                                        @if ($k === $review[$question->id]['correct'] || ($k === $review[$question->id]['correct'] && $k === $review[$question->id]['answer']))
                                                            <span class="badge bg-light-success text-success p-1 mb-2">Correct answer</span>
                                                        @endif
                                                        @if ($k !== $review[$question->id]['correct'] && $k === $review[$question->id]['answer'])
                                                            <span class="badge bg-light-danger text-danger p-1 mb-2">Your answer is incorrect</span>
                                                        @endif
                                                    @elseif ($k === $review[$question->id]['correct'])
                                                        <span class="badge bg-light-success text-success p-1 mb-2">Correct answer</span>
                                                    @endif

                                                    <div class="d-flex align-items-start">
                                                        @if (isset($review[$question->id]['answer']))
                                                            @if ($k === $review[$question->id]['correct'] || ($k === $review[$question->id]['correct'] && $k === $review[$question->id]['answer']))
                                                                <i class="fas fa-circle-check text-success pe-3 py-1"></i>
                                                            @elseif ($k !== $review[$question->id]['correct'] && $k === $review[$question->id]['answer'])
                                                                <i class="fas fa-circle-xmark text-danger pe-3 py-1"></i>
                                                            @else
                                                                <i class="far fa-circle text-dark pe-3 py-1"></i>
                                                            @endif
                                                        @elseif ($k === $review[$question->id]['correct'])
                                                            <i class="fas fa-circle-check text-success pe-3 py-1"></i>
                                                        @else
                                                            <i class="far fa-circle text-dark pe-3 py-1"></i>
                                                        @endif
                                                        <h6 class="ms-1 fw-semibold mb-0" style="color: {{$status}}">
                                                            {!! $question->$option !!}
                                                        </h6>
                                                    </div>
                                                </div>
                                                @endif
                                            @endforeach
                                            <div class="mt-5 rounded py-3 px-3 w-100" style="border: 1px solid #000;">
                                                <h6 class="fw-bold">Overall Explanation</h6>
                                                <div class="mb-1">
                                                    <span class="h6 text-dark fw-bold">Correct Answer:</span>
                                                    {{ Str::upper($review[$question->id]['correct']) }}.
                                                </div>
                                                <div class="mb-0">{!! $question->explanation !!}</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                    @else
                        @if ($isStarted && !$isSubmitted)
                            {{-- Quiz View --}}
                            <form wire:submit.prevent="submitQuiz">
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
                        {{-- Welcome --}}
                        <div class="card-body px-5 pt-5">
                            <h5 class="mb-2">{{ $test->certification->title }} {{ $test->name }} - Attempts</h5>
                            <hr>
                            <div style="height: 100%" class="w-100 d-flex flex-column justify-content-start">
                                <h2 class="mt-3">Welcome to the Quiz!</h2>
                                <div>
                                    <p>Press the button below to take the quiz. You will have {{ $this->test->time_limit }} minutes to complete it.</p>
                                </div>
                                <div class="mt-2">
                                    <button type="button" wire:click="startQuiz" class="btn btn-primary btn-md px-4">
                                        Attempt Exam
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Result VIew --}}
                        @if (!is_null($attempts))
                        <div class="card-body px-5">
                            <hr>
                            @foreach ($attempts as $key => $attempt)
                            <div class="card h-100 rounded-4 p-3 p-sm-4 mb-3" style="border: 2px solid #000;">
                                <div class="d-flex align-items-center justify-content-between pb-2 mb-1">
                                    <h3 class="fw-bold {{ $attempt->status == 'passed' ? 'text-success' : 'text-danger' }} text-capitalize mb-0">
                                        {{ $attempt->status }}</h3>
                                    <h4 class="h5 ms-auto mb-0">{{ score_percent($this->test->id, $attempt->score) }}% correct</h4>
                                    <div class="d-flex ms-auto">
                                        <button wire:click="reviewAttempt({{$attempt->id}})" type="button" class="btn btn-outline-dark px-3">
                                            Review
                                        </button>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center pb-2 mb-1">
                                    @php
                                        $correct_ans = json_decode($attempt->correct_ans, true);
                                        $wrong_ans = json_decode($attempt->wrong_ans, true);
                                        $skipped_ans = json_decode($attempt->skipped_ans, true);
                                    @endphp
                                    <p class="fw-bold text-success mb-0">{{ !empty($correct_ans) ? count($correct_ans) : 0 }} Correct</p>
                                    <p class="fw-bold text-danger ms-3 mb-0">{{ !empty($wrong_ans) ? count($wrong_ans) : 0 }} Wrong</p>
                                    <p class="fw-bold text-dark ms-3 mb-0">{{ !empty($skipped_ans) ? count($skipped_ans) : 0 }} Skipped/Unanswered</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        @endif
                    @endif

                </div>
            </div>

            <div class="col-md-3">
                <div class="d-flex d-md-block flex-wrap position-sticky top-0 border border-3 p-2">
                    <div class="card card-primary">
                        <div class="card-body">
                            @if ($isStarted && !$isSubmitted)
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
                            @if ($isStarted && !$isSubmitted && !$isFinished)
                            <div class="mt-3">
                                <button wire:click="finishQuiz" type="button" class="btn btn-outline-success w-100" id="submit">Finish Exam</button>
                            </div>
                            @endif
                            @if (!$isStarted)
                            <div>
                                <button wire:click="startQuiz" type="button" class="btn btn-primary w-100" id="submit">Attempt Exam</button>
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
