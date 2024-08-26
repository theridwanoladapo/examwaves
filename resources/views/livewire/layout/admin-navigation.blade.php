<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

?>
<div>
    <div class="header header-light">
        <div class="container">
            <nav id="navigation" class="navigation navigation-landscape">
                <div class="nav-header">
                    <a class="nav-brand" href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }}" class="logo" alt=""></a>
                    {{-- <div class="nav-toggle"></div> --}}
                    <div class="mobile_nav">
                        <ul>
                            <li>
                                <div class="btn-group account-drop">
                                    <button type="button" class="btn btn-order-by-filt" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{ asset('assets/img/user-5.png') }}" class="img-fluid circle" alt="">
                                    </button>
                                    <div class="dropdown-menu pull-right animated flipInX">
                                        <div class="drp_menu_headr">
                                            <h4>Hi, {{ auth()->user()->name }}</h4>
                                            <div class="drp_menu_headr-right">
                                                <button wire:click="logout" class="btn btn-whites">Logout</button>
                                            </div>
                                        </div>
                                        <ul>
                                            <li><a href="{{ route('admin.dashboard') }}">
                                                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
                                            </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="nav-menus-wrapper" style="transition-property: none;">
                    <ul class="nav-menu nav-menu-social align-to-right">
                        <li>
                            <div class="btn-group account-drop">
                                <button type="button" class="btn btn-order-by-filt" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ asset('assets/img/ico.png') }}" class="img-fluid circle" alt="">
                                </button>
                                <div class="dropdown-menu pull-right animated flipInX">
                                    <div class="drp_menu_headr">
                                        <h4>Hi, {{ auth()->user()->name }}</h4>
                                        <div class="drp_menu_headr-right">
                                            <button wire:click="logout" class="btn btn-whites">Logout</button>
                                        </div>
                                    </div>
                                    <ul>
                                        <li><a href="{{ route('admin.dashboard') }}">
                                            <i class="fa fa-tachometer-alt me-2"></i>Dashboard
                                        </a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- End Navigation -->
    <div class="clearfix"></div>
</div>
