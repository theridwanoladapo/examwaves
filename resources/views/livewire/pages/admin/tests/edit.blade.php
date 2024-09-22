<?php

use App\Livewire\Forms\TestForm;
use App\Models\Certification;

use function Livewire\Volt\{state, mount};
use function Livewire\Volt\form;
use function Livewire\Volt\layout;

$getCertifications = fn () => $this->certifications = Certification::all();

state(['test', 'certifications' => $getCertifications]);

form(TestForm::class);

layout('layouts.admin');

mount(function () {
    $this->form->setTest($this->test);
});

$updateTest = function () {

    $this->form->update();

    return $this->redirectRoute('admin.tests.view', [$this->test->id], navigate: true);
}

?>

<div>

    <div class="dash-wrapsw card border-0 rounded-4 py-4 mb-4">
        <div class="card-headers border-0 py-4 px-4 pb-0 pt-1">
            <h4><i class="fa-solid fa-pen-fancy text-primary me-2"></i>Add new test</h4>
        </div>

        <div class="card-body px-4">
            <!-- Session Status -->
            <x-auth-session-status class="h6 mb-4" :status="session('status')" />

            <form wire:submit.prevent="updateTest">

                <div class="row mt-0 mt-lg-2">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger fw-bold">*</span></label>
                        <input wire:model="form.name" name="name" id="name" type="text" class="form-control" placeholder="Test name">
                        @error('form.name') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="time_limit" class="form-label">Time Limit (in minutes) <span class="text-danger fw-bold">*</span></label>
                        <input wire:model="form.time_limit" name="time_limit" id="time_limit" type="number" class="form-control" placeholder="Test Time Limit">
                        @error('form.time_limit') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pass_percent" class="form-label">Pass Percentage <span class="text-danger fw-bold">*</span></label>
                        <input wire:model="form.pass_percent" name="pass_percent" id="pass_percent" type="number" class="form-control" placeholder="Test Pass Percentage">
                        @error('form.pass_percent') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="certification_id" class="form-label">Certification <span class="text-danger fw-bold">*</span></label>
                        <select wire:model="form.certification_id" name="certification_id" id="certification_id" class="form-select" placeholder="Certification">
                            <option>Select</option>
                            @foreach ($certifications as $certification)
                            <option value="{{ $certification->id }}">{{ $certification->title }}</option>
                            @endforeach
                        </select>
                        @error('form.certification_id') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>

                </div>

                <div class="d-flex justify-content-start pt-3">
                    <button class="btn btn-md btn-primary me-3" type="submit">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>
