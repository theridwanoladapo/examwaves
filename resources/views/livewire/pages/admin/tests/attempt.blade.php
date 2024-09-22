<?php
use App\Models\Question;

use function Livewire\Volt\{state, mount, on};

$getQuestions = fn () => $this->questions = Question::where('test_id', $this->test->id)->get();
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
    'onReview' => false,
    'review',
    'timeLeft' => null,
]);

mount(function () {
    foreach ($this->quizzes as $key => $question) {
        $correct_options = Str::lower($question->correct_options);

        if ($question->answer_type == "multi_opt") {
            $this->quiz[$question->id] = ['answer' => []];
            $this->quiz[$question->id] = ['correct' => explode(',', $correct_options)];
        } else {
            $this->quiz[$question->id] = ['answer' => null];
            $this->quiz[$question->id] = ['correct' => $correct_options];
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

$returnToResults = fn () => $this->onReview = false;

$reviewQuestions = fn () => $this->onReview = true;

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
        'correct_ans' => $correct_ans,
        'wrong_ans' => $wrong_ans,
        'skipped_ans' => $skipped_ans,
        'time_spent' => ($this->test->time_limit*60 - $this->timeLeft),
    ];

    // assign data to review
    $this->review = $data;

    $this->isSubmitted = true;
}

?>

<div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="row">
            <div class="col-md-9">
                <div class="ps-md-4 ps-lg-3 overflow-y-auto border border-3 rounded" style="height: 450px">

                    {{-- {{ dd($questions) }} --}}
                    @if ($onReview)
                    {{-- <div class="accordion" id="accordionExample" wire:ignore>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    Accordion Item #1
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse
                                    plugin adds the appropriate classes that we use to style each element. These classes control the overall
                                    appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with
                                    custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go
                                    within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Accordion Item #2
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse
                                    plugin adds the appropriate classes that we use to style each element. These classes control the overall
                                    appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with
                                    custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go
                                    within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Accordion Item #3
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse
                                    plugin adds the appropriate classes that we use to style each element. These classes control the overall
                                    appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with
                                    custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go
                                    within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- Questions Review --}}
                    <div class="card-body px-4 py-4">
                        <h5>{{ $test->certification->title }} {{ $test->name }} - Results Review</h5>
                        <hr>
                        @if ($isSubmitted)
                        <button wire:click="returnToResults" type="button" class="btn btn-sm btn-light mb-3">
                            <i class="fas fa-chevron-left me-2"></i> Back to Result Overview
                        </button>
                        @else
                        <button wire:click="returnToResults" type="button" class="btn btn-sm btn-light mb-3">
                            <i class="fas fa-chevron-left me-2"></i> Back to Welcome
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

                                                @if (isset($quiz[$question->id]['answer']))
                                                    @if (is_null($quiz[$question->id]['answer']) || empty($quiz[$question->id]['answer']))
                                                        <i class="fa fa-circle text-muted"></i>
                                                    @else
                                                        @if ($quiz[$question->id]['correct'] === $quiz[$question->id]['answer'])
                                                        <i class="fa fa-circle-check text-success"></i>
                                                        @else
                                                        <i class="fa fa-circle-exclamation text-danger"></i>
                                                        @endif
                                                    @endif
                                                @endif
                                                Question {{ $key + 1 }}
                                                @if (isset($quiz[$question->id]['answer']))
                                                    @if (is_null($quiz[$question->id]['answer']) || empty($quiz[$question->id]['answer']))
                                                        <span class="text-muted fw-medium h6 ms-3 mb-1">Skipped</span>
                                                    @else
                                                        @if ($quiz[$question->id]['correct'] === $quiz[$question->id]['answer'])
                                                        <span class="text-success fw-medium h6 ms-3 mb-1">Correct</span>
                                                        @else
                                                        <span class="text-danger fw-medium h6 ms-3 mb-1">Wrong</span>
                                                        @endif
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
                                                    if (isset($quiz[$question->id]['answer'])) {
                                                        if (in_array($k, $quiz[$question->id]['correct'])
                                                            || in_array($k, $quiz[$question->id]['answer'])) {
                                                            $status = '#00ba74';
                                                        }
                                                        if (!in_array($k, $quiz[$question->id]['correct'])
                                                            && in_array($k, $quiz[$question->id]['answer'])) {
                                                            $status = '#dc3545';
                                                        }
                                                    } elseif (in_array($k, $quiz[$question->id]['correct'])) {
                                                        $status = '#00ba74';
                                                    }
                                                @endphp
                                                <div class="mt-3 rounded py-3 px-3 w-100" style="border: 1px solid {{$status}};">
                                                    @if (isset($quiz[$question->id]['answer']))
                                                        @if (in_array($k, $quiz[$question->id]['correct']) || (in_array($k, $quiz[$question->id]['correct']) && in_array($k, $quiz[$question->id]['answer'])))
                                                            <span class="badge bg-light-success text-success p-1 mb-2">Correct answer</span>
                                                        @elseif (!in_array($k, $quiz[$question->id]['correct']) && in_array($k, $quiz[$question->id]['answer']))
                                                            <span class="badge bg-light-danger text-danger p-1 mb-2">Your answer is incorrect</span>
                                                        @endif
                                                    @elseif (in_array($k, $quiz[$question->id]['correct']))
                                                        <span class="badge bg-light-success text-success p-1 mb-2">Correct answer</span>
                                                    @endif
                                                    <div class="d-flex align-items-start">
                                                        @if (isset($quiz[$question->id]['answer']))
                                                            @if (in_array($k, $quiz[$question->id]['correct']) || (in_array($k, $quiz[$question->id]['correct']) && in_array($k, $quiz[$question->id]['answer'])))
                                                            <i class="fas fa-square-check text-success pe-3 py-1"></i>
                                                            @elseif (!in_array($k, $quiz[$question->id]['correct']) && in_array($k, $quiz[$question->id]['answer']))
                                                            <i class="fas fa-square-xmark text-danger pe-3 py-1"></i>
                                                            @else
                                                            <i class="far fa-square text-dark pe-3 py-1"></i>
                                                            @endif
                                                        @elseif (in_array($k, $quiz[$question->id]['correct']))
                                                            <span class="badge bg-light-success text-success p-1 mb-2">Correct answer</span>
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
                                                    {{ Str::upper(implode(', ', $quiz[$question->id]['correct'])) }}.
                                                </div>
                                                <div class="mb-0">{!! $question->explanation !!}</div>
                                            </div>
                                        @endif
                                        {{-- One answer type --}}
                                        @if ($question->answer_type == "one_opt")
                                            @foreach ($options as $k => $option)
                                                @if (!is_null($question->$option) || $question->$option != "")
                                                @php
                                                    $correct_option = 'option_'.$quiz[$question->id]['correct'];
                                                    $status = '#000';
                                                    if (isset($quiz[$question->id]['answer'])) {
                                                        if ($k === $quiz[$question->id]['correct']
                                                            || $k === $quiz[$question->id]['answer']) {
                                                            $status = '#00ba74';
                                                        }
                                                        if ($k !== $quiz[$question->id]['correct']
                                                            && $k === $quiz[$question->id]['answer']) {
                                                            $status = '#dc3545';
                                                        }
                                                    } elseif ($k === $quiz[$question->id]['correct']) {
                                                        $status = '#00ba74';
                                                    }
                                                @endphp
                                                <div class="mt-3 rounded py-3 px-3 w-100" style="border: 1px solid {{$status}};">
                                                    @if (isset($quiz[$question->id]['answer']))
                                                        @if ($k === $quiz[$question->id]['correct'] || ($k === $quiz[$question->id]['correct'] && $k === $quiz[$question->id]['answer']))
                                                            <span class="badge bg-light-success text-success p-1 mb-2">Correct answer</span>
                                                        @endif
                                                        @if ($k !== $quiz[$question->id]['correct'] && $k === $quiz[$question->id]['answer'])
                                                            <span class="badge bg-light-danger text-danger p-1 mb-2">Your answer is incorrect</span>
                                                        @endif
                                                    @elseif ($k === $quiz[$question->id]['correct'])
                                                        <span class="badge bg-light-success text-success p-1 mb-2">Correct answer</span>
                                                    @endif

                                                    <div class="d-flex align-items-start">
                                                        @if (isset($quiz[$question->id]['answer']))
                                                            @if ($k === $quiz[$question->id]['correct'] || ($k === $quiz[$question->id]['correct'] && $k === $quiz[$question->id]['answer']))
                                                                <i class="fas fa-circle-check text-success pe-3 py-1"></i>
                                                            @elseif ($k !== $quiz[$question->id]['correct'] && $k === $quiz[$question->id]['answer'])
                                                                <i class="fas fa-circle-xmark text-danger pe-3 py-1"></i>
                                                            @else
                                                                <i class="far fa-circle text-dark pe-3 py-1"></i>
                                                            @endif
                                                        @elseif ($k === $quiz[$question->id]['correct'])
                                                                <i class="fas fa-circle-check text-success pe-3 py-1"></i>
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
                                                    {{ Str::upper($quiz[$question->id]['correct']) }}.
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
                        @if ($isStarted)

                            @if (!$isSubmitted)
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
                            {{-- Result VIew --}}
                            <div class="card-body px-5 py-4">
                                <h5 class="mb-2">{{ $test->certification->title }} {{ $test->name }} - Results</h5>
                                <hr>
                                {{-- Single Order --}}
                                <div class="card h-100 rounded-4 p-3 p-sm-4" style="border: 2px solid #000;">
                                    <div class="d-flex align-items-center justify-content-between pb-2 mb-1">
                                        <h3 class="fw-bold {{ $review['status'] == 'passed' ? 'text-success' : 'text-danger' }} text-capitalize mb-0">
                                            {{ $review['status'] }}</h3>
                                        <h4 class="h5 ms-auto mb-0">{{ score_percent($this->test->id, $review['score']) }}% correct</h4>
                                        <div class="d-flex ms-auto">
                                            <button wire:click="reviewQuestions" type="button" class="btn btn-outline-dark" >
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
                        {{-- Welcome Welcome --}}
                        <div class="card card-body">
                            <div style="height: 100%" class="w-100 d-flex flex-column justify-content-start">
                                <h2 class="mt-3">Welcome to the Quiz!</h2>
                                <div>
                                    <p>Press the button below to start the quiz. You will have {{ $this->test->time_limit }} minutes to complete it.</p>
                                </div>
                                <div class="mt-3">
                                    <button type="button" wire:click="startQuiz" class="btn btn-primary px-4">
                                        Take Exam
                                    </button>
                                    <button wire:click="reviewQuestions" type="button" class="btn btn-outline-dark" >
                                        Review Questions
                                    </button>
                                </div>
                            </div>
                        </div>

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
