<?php

use App\Livewire\Forms\ExamForm;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.admin');

form(ExamForm::class);

$storeExam = function () {
    
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

            <form wire:submit="storeExam">

    
                {{-- <div class="d-flex align-items-center">
                    <div class="author-fluid me-3">
                        <img src="assets/img/team-1.jpg" class="img-fluid circle" width="100" alt="Img">
                    </div>
                    <div class="author-fluid">
                        <button class="btn btn-md btn-primary me-2 my-1" type="button">Upload New</button>
                        <button class="btn btn-md btn-light-danger me-2 my-1" type="button"><i class="fa-solid fa-trash me-2"></i>Delete</button>
                    </div>
                </div> --}}
                
                <div class="row mt-0 mt-lg-2">
                
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger fw-bold">*</span></label>
                        <input wire:model="form.name" name="name" id="name" type="text" class="form-control" placeholder="Exam name">
                        <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea wire:model="form.description" name="description" id="description" rows="3" class="form-control" placeholder="Exam Description"></textarea>
                        <x-input-error :messages="$errors->get('form.description')" class="mt-2" />
                    </div>
                    
                </div>
                
                <div class="d-flex justify-content-start pt-3">
                    <button class="btn btn-md btn-primary me-3" type="submit">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>
