<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\layout;

layout('layouts.guest');

$sendVerification = function () {
    if (Auth::user()->hasVerifiedEmail()) {
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);

        return;
    }

    Auth::user()->sendEmailVerificationNotification();

    Session::flash('status', 'verification-link-sent');
};

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
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
                                <i class="fa-solid fa-envelope-open-text fs-1"></i>
                            </div>

                            <div class="card-wrap text-center mb-4">
                                <h1 class="fs-2">Check your email</h1>
                                <p class="mb-4">
                                    Thanks for signing up! <br>
                                    Before getting started, could you verify your email address by clicking on the link we just emailed to you? <br>
                                    If you didn't receive the email, we will gladly send you another.
                                </p>
                                 @if (session('status') == 'verification-link-sent')
                                    <div class="mb-4 font-medium text-sm text-success">
                                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                    </div>
                                @endif
                            </div>

                            <div>

                                <button wire:click="sendVerification" class="btn btn-lg btn-info w-100" type="button">
                                    {{ __('Resend Verification Email') }}
                                </button>
                                <button wire:click="logout" type="submit" class="btn btn-sm btn-light w-100 mt-2 py-3 text-muted font-medium fs-6">
                                    <i class="fa-solid fa-arrow-left me-2"></i> Back To Login
                                </button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    {{-- <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <x-primary-button wire:click="sendVerification">
            {{ __('Resend Verification Email') }}
        </x-primary-button>

        <button wire:click="logout" type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ __('Log Out') }}
        </button>
    </div> --}}
</div>
