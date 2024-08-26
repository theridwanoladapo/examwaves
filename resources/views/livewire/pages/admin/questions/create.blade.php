<?php

use App\Livewire\Forms\QuestionForm;
use App\Models\Exam;
use App\Models\Certification;
use App\Models\Test;
use App\Models\Question;

use function Livewire\Volt\{state, updated, usesFileUploads};
use function Livewire\Volt\form;
use function Livewire\Volt\layout;

usesFileUploads();

$getExams = fn () => $this->exams = Exam::all();
$getCertifications = fn () => $this->certifications = Certification::where('exam_id', $this->exam)->get();
$getTests = fn () => $this->tests = Test::where('certification_id', $this->certification)->get();

state([
    'image',
    'exam',
    'certification',
    'test',
    'exams' => $getExams,
    'certifications',
    'tests',
    'answer_type',
]);

updated([
    'exam' => function () {
        $this->test = null;
        $this->tests = null;
        $this->certification = null;
        $this->certifications = null;
        $this->getCertifications();
    },
    'certification' => function () {
        $this->test = null;
        $this->tests = null;
        $this->getTests();
    },
]);

form(QuestionForm::class);

layout('layouts.admin');

$storeQuestion = function () {

    $this->form->test_id = $this->test;
    $this->form->image = $this->image;

    $this->form->store();

    return $this->redirectRoute('admin.questions.create', navigate: true);
}

?>

<div>
    <div class="dash-wrapsw card border-0 rounded-4 py-4 mb-4">
        <div class="card-headers border-0 py-4 px-4 pb-0 pt-1">
            <h4><i class="fa-solid fa-plus text-primary me-2"></i>Add Questions</h4>
        </div>

        <div class="card-body px-4">
            <!-- Session Status -->
            <x-auth-session-status class="h6 mb-4" :status="session('status')" />

            <form wire:submit.prevent="storeQuestion">

                <div class="row g-3 g-sm-4 mt-0 mb-3 mt-lg-2">

                    <div class="col-sm-4">
                        <label for="exam" class="form-label">Exam <span class="text-danger fw-bold">*</span></label>
                        <select wire:model.live="exam" name="exam" id="exam" class="form-select" placeholder="Exam">
                            <option>Select</option>
                            @foreach ($this->exams as $exam)
                            <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                            @endforeach
                        </select>
                        @error('exam') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="certification" class="form-label">Certification <span class="text-danger fw-bold">*</span></label>
                        <select wire:model.live="certification" name="certification" id="certification" class="form-select" placeholder="Certication">
                            <option>Select</option>
                            @if ($this->certifications)
                            @foreach ($this->certifications as $certification)
                            <option value="{{ $certification->id }}">{{ $certification->title }}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('certification') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="test" class="form-label">Test <span class="text-danger fw-bold">*</span></label>
                        <select wire:model.live="test" name="test" id="test" class="form-select" placeholder="Test">
                            <option>Select</option>
                            @if ($this->tests)
                            @foreach ($this->tests as $test)
                            <option value="{{ $test->id }}">{{ $test->name }}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('test') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>

                </div>

                <div class="row mt-0 mt-lg-2">

                    <div class="mb-3">
                        <label for="question" class="form-label">Question <span class="text-danger fw-bold">*</span></label>
                        <input wire:model="form.question" name="question" id="question" type="text" class="form-control" placeholder="question...">
                        @error('form.question') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Question Image</label>
                        <input wire:model="image" type="file" accept="image/png, image/jpeg, image/jpg" id="image" class="border w-100">
                        @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" class="img-fluid rounded bg-white p-2 mt-1 border border-3" style="max-height: 200px" alt="Img">
                        @endif
                        <div wire:loading wire:target="file" class="text-success ms-3">Uploading...</div>
                        @error('form.image') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="answer_type" class="form-label">Answer Test <span class="text-danger fw-bold">*</span></label>
                        <select wire:model="form.answer_type" name="answer_type" id="answer_type" class="form-select">
                            <option>Select Answer Type</option>
                            <option value="one_opt">{{ answer_type_human('one_opt') }}</option>
                            <option value="multi_opt">{{ answer_type_human('multi_opt') }}</option>
                            <option value="bool">{{ answer_type_human('bool') }}</option>
                            <option value="typed">{{ answer_type_human('typed') }}</option>
                        </select>
                        @error('form.answer_type') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>

                </div>

                <div class="row mt-0 mt-lg-2">

                    <div class="mb-3">
                        <label for="option_a" class="form-label">Option A</label>
                        <input wire:model="form.option_a" name="option_a" id="option_a" type="text" class="form-control" placeholder="Option A...">
                    </div>
                    <div class="mb-3">
                        <label for="option_b" class="form-label">Option B</label>
                        <input wire:model="form.option_b" name="option_b" id="option_b" type="text" class="form-control" placeholder="Option B...">
                    </div>
                    <div class="mb-3">
                        <label for="option_c" class="form-label">Option C</label>
                        <input wire:model="form.option_c" name="option_c" id="option_c" type="text" class="form-control" placeholder="Option C...">
                    </div>
                    <div class="mb-3">
                        <label for="option_d" class="form-label">Option D</label>
                        <input wire:model="form.option_d" name="option_d" id="option_d" type="text" class="form-control" placeholder="Option D...">
                    </div>
                    <div class="mb-3">
                        <label for="option_e" class="form-label">Option E</label>
                        <input wire:model="form.option_e" name="option_e" id="option_e" type="text" class="form-control" placeholder="Option E...">
                    </div>
                    <div class="mb-3">
                        <label for="option_f" class="form-label">Option F</label>
                        <input wire:model="form.option_f" name="option_f" id="option_f" type="text" class="form-control" placeholder="Option F...">
                    </div>
                    <div class="mb-3">
                        <label for="option_g" class="form-label">Option G</label>
                        <input wire:model="form.option_g" name="option_g" id="option_g" type="text" class="form-control" placeholder="Option G...">
                    </div>
                    <div class="mb-3">
                        <label for="correct_options" class="form-label">Correct Option(s)</label>
                        <input wire:model="form.correct_options" name="correct_options" id="correct_options" type="text" class="form-control" placeholder="Correct Option(s)...">
                        @error('form.correct_options') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="explanation" class="form-label">Correct Answer Explanation</label>
                        <input wire:model="form.explanation" name="explanation" id="explanation" type="text" class="form-control" placeholder="Correct Answer Explanation...">
                    </div>

                </div>

                <div class="d-flex justify-content-start pt-3">
                    <button class="btn btn-md btn-primary me-3" type="submit">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>
