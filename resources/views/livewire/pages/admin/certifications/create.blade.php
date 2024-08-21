<?php

use App\Livewire\Forms\CertificationForm;

use function Livewire\Volt\{state, usesFileUploads};
use function Livewire\Volt\form;
use function Livewire\Volt\layout;
 
usesFileUploads();

state(['image', 'exams']);

layout('layouts.admin');

form(CertificationForm::class);

$storeCertification = function () {

    $this->form->image =  $this->image;

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
                        <label for="title" class="form-label">Title <span class="text-danger fw-bold">*</span></label>
                        <input wire:model="form.title" name="title" id="title" type="text" class="form-control" placeholder="Exam Certication title">
                        @error('form.title') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="code" class="form-label">Code <span class="text-danger fw-bold">*</span></label>
                        <input wire:model="form.code" name="code" id="code" type="text" class="form-control" placeholder="Exam Certication code (e.g A1-900)">
                        @error('form.code') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input wire:model="form.description" name="description" id="description" type="text" class="form-control" placeholder="Exam Certication description">
                        @error('form.description') <span class="text-danger mt-3">{{ $message }}</span> @enderror
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
                        @error('form.rating') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price <span class="text-danger fw-bold">*</span></label>
                        <input wire:model="form.price" name="price" id="price" type="number" class="form-control" placeholder="Exam Certication price">
                        @error('form.price') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exam_id" class="form-label">Exam <span class="text-danger fw-bold">*</span></label>
                        <select wire:model="form.exam_id" name="exam_id" id="exam_id" class="form-select" placeholder="Certication exam">
                            <option>Select</option>
                            @foreach ($exams as $exam)
                            <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                            @endforeach
                        </select>
                        @error('form.exam_id') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>
                    
                </div>
                
                <div class="d-flex justify-content-start pt-3">
                    <button class="btn btn-md btn-primary me-3" type="submit">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>
