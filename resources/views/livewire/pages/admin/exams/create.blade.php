<?php

use App\Livewire\Forms\ExamForm;

use function Livewire\Volt\{state, usesFileUploads};
use function Livewire\Volt\form;
use function Livewire\Volt\layout;

usesFileUploads();

state(['image', 'description', 'isMenu' => false]);

layout('layouts.admin');

form(ExamForm::class);

$storeExam = function () {

    $this->form->image =  $this->image;
    $this->form->description =  $this->description ?? '';
    $this->form->isMenu =  $this->isMenu;

    $this->form->store();

    return $this->redirectRoute('admin.exams.index', navigate: true);
}

?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="dash-wrapsw card border-0 rounded-4 py-4 mb-4">
        <div class="card-headers border-0 py-4 px-4 pb-0 pt-1">
            <h4><i class="fa-solid fa-pen-fancy text-primary me-2"></i>Add new exam</h4>
        </div>

        <div class="card-body px-4">

            <form wire:submit.prevent="storeExam">

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
                        <div class="form-check">
                            <input wire:model="isMenu" class="form-check-input" type="checkbox" id="is-menu">
                            <label class="form-check-label text-dark fw-medium ms-1" for="is-menu">Add to main menu</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <div wire:ignore>
                            <textarea wire:model="description" name="description" id="description" class="form-control" placeholder="Exam Description"></textarea>
                        </div>
                    </div>

                </div>

                <div class="d-flex justify-content-start pt-3">
                    <button class="btn btn-md btn-primary me-3" type="submit">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>

@script
<script>
    $(function () {
        $('#description').summernote({
            placeholder: 'Write description here...',
            tabsize: 4,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['help']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('description', contents);
                }
            }
        });
    });
</script>
@endscript
