<?php

use App\Livewire\Forms\ExamForm;

use function Livewire\Volt\{mount, state, usesFileUploads};
use function Livewire\Volt\form;
use function Livewire\Volt\layout;

usesFileUploads();

state(['image', 'exam']);

form(ExamForm::class);

layout('layouts.admin');

mount(function () {
    $this->form->setExam($this->exam);
});

$updateExam = function () {

    $this->form->image =  $this->image;

    $this->form->update();

    return $this->redirectRoute('admin.exams.view', [$this->exam->id], navigate: true);
}

?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="dash-wrapsw card border-0 rounded-4 py-4 mb-4">
        <div class="card-headers border-0 py-4 px-4 pb-0 pt-1">
            <h4><i class="fa-solid fa-pen-fancy text-primary me-2"></i>Edit exam</h4>
        </div>

        <div class="card-body px-4">

            <form wire:submit.prevent="updateExam">

                <div class="mb-3">
                    <div class="author-fluid mb-3">
                        @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" class="img-fluid rounded bg-white p-2 border border-3" width="100" height="100" alt="Img">
                        @else
                        <img src="{{ asset('assets/img/icon.png') }}" class="img-fluid rounded bg-white p-2 border border-3" width="100" height="100" alt="Img">
                        @endif
                    </div>
                    <div class="author-fluid d-flex align-items-center">
                        <input wire:model="image" type="file" accept="image/png, image/jpeg, image/jpg" id="image" class="border">
                        <div wire:loading wire:target="image" class="text-success ms-3">Uploading...</div>
                    </div>
                </div>
                @error('form.image') <span class="text-danger mt-3">{{ $message }}</span> @enderror

                <div class="row mt-0 mt-lg-2">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger fw-bold">*</span></label>
                        <input wire:model="form.name" name="name" id="name" type="text" class="form-control" placeholder="Exam name">
                        @error('form.name') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea wire:model="form.description" name="description" id="description" rows="3" class="form-control" placeholder="Exam Description"></textarea>
                    </div>

                </div>

                <div class="d-flex justify-content-start pt-3">
                    <button class="btn btn-md btn-primary me-3" type="submit">Update</button>
                </div>

            </form>
        </div>
    </div>
</div>