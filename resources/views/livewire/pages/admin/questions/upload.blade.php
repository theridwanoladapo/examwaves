<?php

use App\Livewire\Forms\UploadForm;
use App\Models\Exam;
use App\Models\Certification;
use App\Models\Test;

use function Livewire\Volt\{state, updated, usesFileUploads};
use function Livewire\Volt\form;
use function Livewire\Volt\layout;

usesFileUploads();

$getExams = fn () => $this->exams = Exam::all();
$getCertifications = fn () => $this->certifications = Certification::where('exam_id', $this->exam)->get();
$getTests = fn () => $this->tests = Test::where('certification_id', $this->certification)->get();

state([
    'file',
    'exam',
    'certification',
    'test',
    'exams' => $getExams,
    'certifications',
    'tests',
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

form(UploadForm::class);

layout('layouts.admin');

$uploadQuestions = function () {

    $this->form->test_id = $this->test;
    $this->form->file = $this->file;

    $this->form->import();

    session()->flash('success', 'Questions has been uploaded to test successfully!');

    return $this->redirectRoute('admin.questions.upload', navigate: true);
};

?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('success')" />

    <div class="dash-wrapsw card border-0 rounded-4 py-4 mb-4">
        <div class="card-headers border-0 py-4 px-4 pb-0 pt-1">
            <h4><i class="fa-solid fa-upload text-primary me-2"></i>Upload Questions</h4>
        </div>

        <div class="card-body px-4">
            <!-- Session Status -->
            <x-auth-session-status class="h6 mb-4" :status="session('status')" />

            <form wire:submit.prevent="uploadQuestions">

                <div class="row mt-0 mt-lg-2">

                    <div class="mb-3">
                        <label for="exam" class="form-label">Exam <span class="text-danger fw-bold">*</span></label>
                        <select wire:model.live="exam" name="exam" id="exam" class="form-select" placeholder="Exam">
                            <option>Select</option>
                            @foreach ($this->exams as $exam)
                            <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                            @endforeach
                        </select>
                        @error('exam') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
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
                    <div class="mb-3">
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

                <div class="mb-3">
                    <div class="mb-3">
                        <label for="file" class="form-label">File <span class="text-danger fw-bold">*</span></label>
                        <input wire:model="file" type="file"
                        accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                        id="file" class="border w-100" required>
                        <div wire:loading wire:target="file" class="text-success ms-3">Uploading...</div>
                    </div>
                </div>
                @error('form.file') <span class="text-danger mt-3">{{ $message }}</span> @enderror

                <div class="d-flex justify-content-start pt-3">
                    <button class="btn btn-md btn-primary me-3" type="submit">Upload</button>
                </div>

            </form>
        </div>
    </div>
</div>
