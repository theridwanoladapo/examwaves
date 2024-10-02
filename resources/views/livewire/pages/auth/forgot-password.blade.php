<?php

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state(['email' => '']);

rules(['email' => ['required', 'string', 'email']]);

$sendPasswordResetLink = function () {
    $this->validate();

    // We will send the password reset link to this user. Once we have attempted
    // to send the link, we will examine the response then see the message we
    // need to show to the user. Finally, we'll send out a proper response.
    $status = Password::sendResetLink(
        $this->only('email')
    );

    if ($status != Password::RESET_LINK_SENT) {
        $this->addError('email', __($status));

        return;
    }

    $this->reset('email');

    Session::flash('status', __($status));
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
                                <h1 class="fs-2">Forgot Password?</h1>
                                <p>No worries, we'll send you reset instructions.</p>
                            </div>

                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <form wire:submit="sendPasswordResetLink">

                                <div class="form-floating position-relative mb-4">
                                    <i class="fa-regular fa-envelope position-absolute top-50 start-0 translate-middle-y ms-3 text-info"></i>
                                    <input wire:model="email" id="email" name="email" type="email" class="form-control form-control-lg ps-5" placeholder="Email address" required autofocus>
                                    <label for="floatingInput" class="ms-4">Email address</label>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <button class="btn btn-lg btn-info w-100" type="submit">Reset Password</button>

                                <p class="pt-4 text-center">
                                    <a class="text-muted" href="{{ route('login') }}">
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
