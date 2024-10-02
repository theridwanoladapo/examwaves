<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state('token')->locked();

state([
    'email' => fn () => request()->string('email')->value(),
    'password' => '',
    'password_confirmation' => ''
]);

rules([
    'token' => ['required'],
    'email' => ['required', 'string', 'email'],
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
]);

$resetPassword = function () {
    $this->validate();

    // Here we will attempt to reset the user's password. If it is successful we
    // will update the password on an actual user model and persist it to the
    // database. Otherwise we will parse the error and return the response.
    $status = Password::reset(
        $this->only('email', 'password', 'password_confirmation', 'token'),
        function ($user) {
            $user->forceFill([
                'password' => Hash::make($this->password),
                'remember_token' => Str::random(60),
            ])->save();

            event(new PasswordReset($user));
        }
    );

    // If the password was successfully reset, we will redirect the user back to
    // the application's home authenticated view. If there is an error we can
    // redirect them back to where they came from with their error message.
    if ($status != Password::PASSWORD_RESET) {
        $this->addError('email', __($status));

        return;
    }

    Session::flash('status', __($status));

    $this->redirectRoute('login', navigate: true);
};

?>

<div>
    <section class="position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-6 com-md-9">

                    <!-- Signup Form -->
                    <div class="position-relative">

                        <div class="card border-0 rounded-5 p-xl-4 p-lg-4 p-3">

                            <div class="square--80 circle bg-light-primary text-primary d-flex mb-4 mx-auto">
                                <i class="fa-solid fa-key fs-1"></i>
                            </div>

                            <div class="card-wrap text-center mb-4">
                                <h1 class="fs-2">Set New Password</h1>
                                <p>Your new password must be different to previously used password.</p>
                            </div>

                            <form wire:submit="resetPassword">

                                <div class="form-floating position-relative mb-4">
                                    <i class="fa-regular fa-envelope position-absolute top-50 start-0 translate-middle-y ms-3 text-info"></i>
                                    <input wire:model="email" id="email" type="email" name="email" class="form-control form-control-lg ps-5" required autocomplete="username" placeholder="Email address">
                                    <label class="ms-4" for="email">Email address</label>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div class="form-floating position-relative mb-4">
                                    <i class="fa-solid fa-lock position-absolute top-50 start-0 translate-middle-y ms-3 text-info"></i>
                                    <input wire:model="password" id="password" type="password" name="password" class="form-control form-control-lg ps-5" required autocomplete="new-password" placeholder="Password">
                                    <label class="ms-4" for="password">Password</label>
                                    <span class="fa-solid fa-eye toggle-password position-absolute top-50 end-0 translate-middle-y me-3 text-info opacity-75"></span>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <div class="form-floating position-relative mb-4">
                                    <i class="fa-solid fa-lock position-absolute top-50 start-0 translate-middle-y ms-3 text-info"></i>
                                    <input wire:model="password_confirmation" id="password_confirmation" type="password" name="password_confirmation" class="form-control form-control-lg ps-5" required autocomplete="new-password" placeholder="Confirm Password">
                                    <label class="ms-4" for="password_confirmation">Password</label>
                                    <span class="fa-solid fa-eye toggle-password position-absolute top-50 end-0 translate-middle-y me-3 text-info opacity-75"></span>
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>

                                <button class="btn btn-lg btn-info w-100" type="submit">Reset Password</button>

                                <p class="pt-4 text-center">
                                    <a class="text-muted" href="{{ route('login') }}" target="_blank">
                                        <i class="fa-solid fa-arrow-left me-2"></i> Back To Login
                                    </a>
                                </p>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
