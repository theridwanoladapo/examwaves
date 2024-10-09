<?php

use App\Models\Exam;

use App\Livewire\Actions\Logout;
use function Livewire\Volt\{state};

$getExams = fn () => $this->exams = Exam::where('isMenu', true)->get();

state(['exams' => $getExams]);

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

?>

<div>
    <div class="header header-light shadow">
        <div class="container">
            <nav id="navigation" class="navigation navigation-landscape">
                <div class="nav-header">
                    <a class="nav-brand" href="{{ route('home') }}" wire:navigate>
                        <img src="{{ asset('assets/img/logo.png') }}" class="logo" alt="">
                    </a>
                    <div class="nav-toggle"></div>
                    <div class="mobile_nav">
                        @auth
                        <ul>
                            <li>
                                <div class="btn-group account-drop">
                                    <button type="button" class="btn btn-order-by-filt" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{ asset('assets/img/user-img.png') }}" class="img-fluid circle" alt="">
                                    </button>
                                    <div class="dropdown-menu pull-right animated flipInX">
                                        <div class="drp_menu_headr">
                                            <h4>Hi, {{ auth()->user()->name }}</h4>
                                            <div class="drp_menu_headr-right">
                                                <button wire:click="logout" class="btn btn-whites"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                                            </div>
                                        </div>
                                        <ul>
                                            <li><a href="{{ route('dashboard') }}" wire:navigate><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                            <li><a href="{{ route('profile') }}" wire:navigate><i class="fa fa-user-tie me-2"></i>My Profile</a></li>
                                            <li><a href="{{ route('exams') }}" wire:navigate><i class="fa-solid fa-pen-fancy me-2"></i>My Exams</a></li>
                                            <li><a href="{{ route('settings') }}" wire:navigate><i class="fa-solid fa-gear me-2"></i>Account Settings</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        @else
                        <ul>
                            <li>
                                <a href="{{{ route('login') }}}" class="btn btn-info"><i class="fas fa-sign-in-alt me-2"></i> Log in</a>
                            </li>
                        </ul>
                        @endauth
                    </div>
                </div>
                <div class="nav-menus-wrapper" style="transition-property: none;">
                    <ul class="nav-menu">

                        <li><a href="{{ route('home') }}" wire:navigate>Home</a></li>

                        <li>
                            <a href="JavaScript:Void(0);">Practice Exams<span class="submenu-indicator"></span></a>
                            <ul class="nav-dropdown">
                                @foreach ($this->exams as $exam)
                                <li>
                                    <a href="{{ route('providers.view', $exam->id) }}" wire:navigate>
                                        <div class="mega-advance-menu">
                                            <div class="mega-last ps-2">
                                                <h6 class="lh-base fs-6 font--bold m-0">{{ $exam->name }}</h6>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                                <li>
                                    <a href="{{ route('providers') }}" wire:navigate>
                                        <div class="mega-advance-menu">
                                            <div class="mega-last ps-2">
                                                <h6 class="lh-base fs-6 font--bold m-0">{{ __('View all') }}</h6>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li><a href="">How it works</a></li>

                        <li><a href="{{ route('contact') }}">Contact Us</a></li>

                    </ul>

                    <livewire:components.cart-icon />

                    @auth
                    <ul class="nav-menu nav-menu-social align-to-right">
                        <li>
                            <div class="btn-group account-drop">
                                <button type="button" class="btn btn-order-by-filt" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ asset('assets/img/user-img.png') }}" class="img-fluid circle" alt="">
                                </button>
                                <div class="dropdown-menu pull-right animated flipInX">
                                    <div class="drp_menu_headr">
                                        <h4>Hi, {{ auth()->user()->name }}</h4>
                                        <div class="drp_menu_headr-right">
                                            <button wire:click="logout" class="btn btn-whites"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                                        </div>
                                    </div>
                                    <ul>
                                        <li><a href="{{ route('dashboard') }}" wire:navigate><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                        <li><a href="{{ route('profile') }}" wire:navigate><i class="fa fa-user-tie me-2"></i>My Profile</a></li>
                                        <li><a href="{{ route('exams') }}" wire:navigate><i class="fa-solid fa-pen-fancy me-2"></i>My Exams</a></li>
                                        <li><a href="{{ route('settings') }}" wire:navigate><i class="fa-solid fa-gear me-2"></i>Account Settings</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                    @else
                    <ul class="nav-menu nav-menu-social align-to-right">
                        <li>
                            <a href="{{ route('login') }}" wire:navigate><i class="fas fa-sign-in-alt me-2"></i> Log in</a>
                        </li>
                        <li class="list-buttons ms-2">
                            <a href="{{ route('register') }}" class="bg-info" wire:navigate>Sign up <i class="fa-regular fa-circle-right ms-2"></i></a>
                        </li>
                    </ul>
                    @endauth
                </div>
            </nav>
        </div>
    </div>
    <!-- End Navigation -->
    <div class="clearfix"></div>

    <div class="bg-primary">
        <div class="container">
            <div class="d-flex justify-content-start">
                <div class="text-light bg-info py-3 px-3">
                    POPULAR EXAM PROVIDERS:
                </div>
                <div class="d-flex justify-content-start">
                    @foreach ($this->exams as $exam)
                    <a href="{{ route('providers.view', $exam->id) }}" class="text-white py-3 px-3">
                        <span>{{ $exam->name }}</span>
                    </a>
                    @endforeach
                    <a href="{{ route('providers') }}" class="text-white py-3 px-3"><span>View all</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
