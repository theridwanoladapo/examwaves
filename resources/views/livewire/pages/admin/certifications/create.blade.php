<?php

use App\Livewire\Forms\CertificationForm;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;
use function Livewire\Volt\{state};
 
state('exams');

layout('layouts.admin');

form(CertificationForm::class);

$storeCertification = function () {
    
    $this->form->store();

    return $this->redirectRoute('admin.certifications.index');
}

?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="dash-wrapsw card border-0 rounded-4 py-4 mb-4">
        <div class="card-headers border-0 py-4 px-4 pb-0 pt-1">
            <h4><i class="fa-solid fa-pen-fancy text-primary me-2"></i>Add new certification</h4>
        </div>

        <div class="card-body px-4">

            <form wire:submit="storeCertification">

    
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
                        <label for="title" class="form-label">Title <span class="text-danger fw-bold">*</span></label>
                        <input wire:model="form.title" name="title" id="title" type="text" class="form-control" placeholder="Exam Certication title">
                        <x-input-error :messages="$errors->get('form.title')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label for="code" class="form-label">Code <span class="text-danger fw-bold">*</span></label>
                        <input wire:model="form.code" name="code" id="code" type="text" class="form-control" placeholder="Exam Certication code (e.g A1-900)">
                        <x-input-error :messages="$errors->get('form.code')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input wire:model="form.description" name="description" id="description" type="text" class="form-control" placeholder="Exam Certication description">
                        <x-input-error :messages="$errors->get('form.description')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select wire:model="form.rating" name="rating" id="rating" class="form-select" placeholder="Certication rating">
                            <option value="0">Select</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                            <option value="4">Four</option>
                            <option value="5">Five</option>
                        </select>
                        <x-input-error :messages="$errors->get('form.rating')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price <span class="text-danger fw-bold">*</span></label>
                        <input wire:model="form.price" name="price" id="price" type="number" class="form-control" placeholder="Exam Certication price">
                        <x-input-error :messages="$errors->get('form.price')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label for="exam_id" class="form-label">Exam <span class="text-danger fw-bold">*</span></label>
                        <select wire:model="form.exam_id" name="exam_id" id="exam_id" class="form-select" placeholder="Certication exam">
                            <option>Select</option>
                            @foreach ($exams as $exam)
                            <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('form.exam_id')" class="mt-2" />
                    </div>
                    
                </div>
                
                <div class="d-flex justify-content-start pt-3">
                    <button class="btn btn-md btn-primary me-3" type="submit">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>
