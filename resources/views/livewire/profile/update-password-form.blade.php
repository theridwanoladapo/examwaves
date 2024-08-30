<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

use function Livewire\Volt\rules;
use function Livewire\Volt\state;

state([
    'current_password' => '',
    'password' => '',
    'password_confirmation' => ''
]);

rules([
    'current_password' => ['required', 'string', 'current_password'],
    'password' => ['required', 'string', Password::defaults(), 'confirmed'],
]);

$updatePassword = function () {
    try {
        $validated = $this->validate();
    } catch (ValidationException $e) {
        $this->reset('current_password', 'password', 'password_confirmation');

        throw $e;
    }

    Auth::user()->update([
        'password' => Hash::make($validated['password']),
    ]);

    $this->reset('current_password', 'password', 'password_confirmation');

    $this->dispatch('password-updated');
};

?>

<div>
    <div class="dash-wrapsw card border-0 rounded-4 py-4 mb-4">
        <div class="card-headers border-0 py-4 px-4 pb-0 pt-1">
            <h5><i class="fa-solid fa-lock text-primary me-2"></i>{{ __('Update Password') }}</h5>
            <p class="mt-1 text-gray-600">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>
        </div>
        <div class="card-body px-4">
            <form wire:submit.prevent="updatePassword">
                <div class="row align-items-center g-3 g-sm-4 pb-3">
                    <div class="col-sm-6">
                        <label class="form-label" for="update_password_current_password">Current Password</label>
                        <input wire:model="current_password" id="update_password_current_password" name="current_password"
                        type="password" class="form-control" autocomplete="current-password" placeholder="********">
                        @error('current_password') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-sm-6">
                        {{-- <a href="" class="fw-semibold text-primary d-flex mt-sm-4">
                            <i class="fa-solid fa-question me-2"></i>Forgot My Password
                        </a> --}}
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="update_password">New Password</label>
                        <input wire:model="password" id="update_password" name="password"
                        type="password" class="form-control" autocomplete="new-password" placeholder="********">
                        @error('password') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="update_password_confirmation">Confirm Password</label>
                        <input wire:model="password_confirmation" id="update_password_confirmation" name="password_confirmation"
                        type="password" class="form-control" autocomplete="new-password" placeholder="********">
                        @error('password_confirmation') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="alert alert-info d-flex rounded-4 mb-0"><i class="ai-circle-info fs-xl me-2"></i>
                    <p class="mb-0">Password must be minimum 8 characters long - the more, the better.</p>
                </div>

                <div class="d-flex justify-content-start pt-3">
                    <button class="btn btn-primary me-3" type="submit">Save changes</button>
                    <x-action-message class="me-3" on="password-updated">
                        {{ __('Saved.') }}
                    </x-action-message>
                </div>
            </form>

        </div>
    </div>
</div>
