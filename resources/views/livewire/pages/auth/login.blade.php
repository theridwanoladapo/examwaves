<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.guest');

form(LoginForm::class);

$login = function () {
    $this->validate();

    $this->form->authenticate();

    $userRole = auth()->user()->role;

    Session::regenerate();

    switch ($userRole) {
        case 1:
            $this->redirectIntended(default: route('admin.dashboard', absolute: false), navigate: true);
            break;
        case 0:
            $this->redirectIntended(default: route('home', absolute: false), navigate: true);
            break;
        default:
            return redirect('/', navigate: true);
            break;
    }
};

?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <section class="position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-6 com-md-9">
                    <div class="position-relative">
                        <div class="d-flex mb-4 justify-content-center">
                            <a href="{{ route('home') }}"><img src="assets/img/ico.png" class="img-fluid" width="60" alt="logo"></a>
                        </div>

                        <div class="card border-0 rounded-5 p-xl-4 p-lg-4 p-3">

                            <div class="card-wrap text-center mb-4">
                                <h1 class="fs-2">Log in</h1>
                                <p>Welcome Back! Log in To Your Account</p>
                            </div>

                            <form wire:submit="login">

                                <div class="form-floating position-relative mb-4">
                                    <i class="fa-regular fa-envelope position-absolute top-50 start-0 translate-middle-y ms-3 text-info"></i>
                                    <input wire:model="form.email" id="email" type="email" name="email" class="form-control form-control-lg ps-5" required autofocus autocomplete="username" placeholder="Email address">
                                    <label class="ms-4" for="email">Email address</label>
                                    <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                                </div>

                                <div class="form-floating position-relative mb-4">
                                    <i class="fa-solid fa-lock position-absolute top-50 start-0 translate-middle-y ms-3 text-info"></i>
                                    <input wire:model="form.password" id="password-field" type="password" name="password" class="form-control form-control-lg ps-5" required autocomplete="current-password" placeholder="Password">
                                    <label class="ms-4" for="password-field">Password</label>
                                    <span class="fa-solid fa-eye toggle-password position-absolute top-50 end-0 translate-middle-y me-3 text-info opacity-75"></span>
                                    <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                                </div>

                                <div class="pb-3">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between pb-4">
                                        <form-check class="my-1">
                                            <input class="form-check-input" wire:model="form.remember" id="remember" type="checkbox" name="remember">
                                            <label class="form-check-label ms-1" for="remember">Keep me signed in</label>
                                        </form-check>
                                        <a class="fs-sm fw-semibold text-decoration-none my-1" href="{{ route('password.request') }}" wire:navigate>
                                            Forgot your password?
                                        </a>
                                    </div>
                                </div>

                                <button class="btn btn-lg btn-info w-100" type="submit">Sign In</button>

                                <p class="pt-4 text-center">
                                    <span class="text-muted">Don't have account?</span>
                                    <a class="text-info font--medium"  href="{{ route('register') }}" wire:navigate>Create An Account</a>
                                </p>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
