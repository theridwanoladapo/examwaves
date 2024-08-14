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
                    <a class="nav-brand" href="#"><img src="{{ asset('assets/img/logo.png') }}" class="logo" alt=""></a>
                    <div class="nav-toggle"></div>
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
                                            <li><a href=""><i class="fa fa-tachometer-alt me-2"></i>User Dashboard<span class="notti_coun style-1">4</span></a></li>
                                            <li><a href=""><i class="fa fa-user-tie me-2"></i>My Profile</a></li>
                                            <li><a href=""><i class="fa-solid fa-gear me-2"></i>Account Setting</a></li>
                                            <li><a href=""><i class="fa-solid fa-wallet me-2"></i>Account Billing</a></li>
                                            <li><a href=""><i class="fa fa-envelope me-2"></i>My Order</a></li>
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
                                        <li><a href="/dashboard"><i class="fa fa-tachometer-alt me-2"></i>User Dashboard<span class="notti_coun style-1">4</span></a></li>
                                        <li><a href="/dashboard"><i class="fa fa-user-tie me-2"></i>My Profile</a></li>
                                        <li><a href="/dashboard"><i class="fa-solid fa-gear me-2"></i>Account Setting</a></li>
                                        <li><a href="/dashboard"><i class="fa-solid fa-wallet me-2"></i>Account Billing</a></li>
                                        <li><a href="/dashboard"><i class="fa fa-envelope me-2"></i>My Order</a></li>
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
