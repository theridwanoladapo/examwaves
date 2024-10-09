<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'name' => '',
    'email' => '',
    'password' => '',
    'password_confirmation' => ''
]);

rules([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
]);

$register = function () {
    $validated = $this->validate();

    $validated['password'] = Hash::make($validated['password']);

    $user = User::create($validated);

    event(new Registered($user));

    Auth::login($user);

    $this->redirect(route('home', absolute: false));
};

?>

<div>
    <div class="d-lg-flex position-relative h-100 bg-white">
        <a class="circle bg-white text-primary border square--40 position-absolute top-0 end-0 mt-3 me-3" href="{{ route('home') }}" data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Back to home" data-bs-original-title="Back to home"><i class="fa-solid fa-house-user"></i></a>

        <!-- Signup Form -->
        <div class="d-flex flex-column align-items-center w-50 h-100 px-4 px-md-5 py-5">
            <div class="w-100 mt-auto py-4 px-xl-4 px-lg-3">
                <div class="d-flex mb-3">
                    <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" width="120" alt="logo">
                </div>

                <h1 class="fs-1">Create An Account</h1>
                <p class="pb-3 mb-3 mb-lg-4">Register to get started</p>
                <form wire:submit="register">

                    <div class="row row-cols-1 row-cols-sm-2">
                        <div class="col mb-4">
                          <input wire:model="name" id="name" class="form-control lg" type="text" name="name" required autofocus autocomplete="name" placeholder="Your name">
                          <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="col mb-4">
                          <input wire:model="email" id="email" class="form-control lg" type="email" name="email" required autocomplete="username" placeholder="Email address">
                          <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mb-4 position-relative">
                        <input wire:model="password" id="password" class="form-control lg" type="password" name="password" required autocomplete="new-password" placeholder="Password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mb-4 position-relative">
                        <input wire:model="password_confirmation" id="password-field" class="form-control lg" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                        <span class="fa-solid fa-eye toggle-password position-absolute top-50 end-0 translate-middle-y me-3"></span>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <button class="btn btn-lg btn-primary w-100" type="submit">Sign Up</button>

                    {{-- <h2 class="h6 font--medium text-muted text-center py-4">Or sign in with your social account</h2> --}}

                    {{-- <div class="row row-cols-1 row-cols-sm-2 gy-3">
                        <div class="col"><a class="btn btn--googleplus w-100 font--medium" href="#"><i class="fa-brands fa-google-plus-g me-2"></i>Google</a></div>
                        <div class="col"><a class="btn btn--facebook w-100 font--medium" href="#"><i class="fa-brands fa-facebook me-2"></i>Facebook</a></div>
                    </div> --}}

                    <p class="pt-4 text-center">
                        <span class="text-muted">Have an account already?</span>
                        <a class="text-primary font--medium" href="{{ route('login') }}" wire:navigate>Login Your Account</a>
                    </p>

                </form>
            </div>
        </div>

        <div class="w-50 bg-cover bg-repeat-0 bg-position-center" style="background-image: url(assets/img/blog-2.jpg);"></div>
    </div>
</div>
