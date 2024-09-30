<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/Jost.css') }}" type="text/css">
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('assets/js/summernote/summernote-lite.min.css') }}">

        @livewireStyles
    </head>
    <body>
        <!-- Preloader -->
        {{-- <div id="preloader">
            <div class="preloader"><span></span><span></span></div>
        </div> --}}

        <div id="main-wrapper">
            <livewire:layout.app-navigation />

            {{ $slot }}

            @auth
            <button type="button" class="d-lg-none btn btn-md btn-primary w-100 rounded-0 fixed-bottom" data-bs-toggle="offcanvas" data-bs-target="#Sidebaruser">
                <i class="fa-solid fa-bars me-2"></i> Dashboard Navigation
            </button>
            <!-- Footer Start -->
            <footer class="footer skin-light-footer">
                <div>
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-3 col-md-4">
                                <div class="footer-widget">
                                    <img src="assets/img/logo.png" class="img-footer" alt="">
                                    <div class="footer-add">
                                        <p>Address 1<br>Address 2</p>
                                    </div>
                                    <div class="foot-socials">
                                        <ul>
                                            <li><a href="JavaScript:Void(0);"><i class="fa-brands fa-facebook"></i></a></li>
                                            <li><a href="JavaScript:Void(0);"><i class="fa-brands fa-linkedin"></i></a></li>
                                            <li><a href="JavaScript:Void(0);"><i class="fa-brands fa-google-plus"></i></a></li>
                                            <li><a href="JavaScript:Void(0);"><i class="fa-brands fa-twitter"></i></a></li>
                                            <li><a href="JavaScript:Void(0);"><i class="fa-brands fa-dribbble"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-4">
                                <div class="footer-widget">
                                    <h4 class="widget-title font--bold">For Clients</h4>
                                    <ul class="footer-menu">
                                        <li><a href="JavaScript:Void(0);">Talent Marketplace</a></li>
                                        <li><a href="JavaScript:Void(0);">Payroll Services</a></li>
                                        <li><a href="JavaScript:Void(0);">Direct Contracts</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-4">
                                <div class="footer-widget">
                                    <h4 class="widget-title">Our Resources</h4>
                                    <ul class="footer-menu">
                                        <li><a href="JavaScript:Void(0);">Free Business tools</a></li>
                                        <li><a href="JavaScript:Void(0);">Affiliate Program</a></li>
                                        <li><a href="JavaScript:Void(0);">Success Stories</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="footer-widget">
                                    <h4 class="widget-title">The Company</h4>
                                    <ul class="footer-menu">
                                        <li><a href="JavaScript:Void(0);">About Us</a></li>
                                        <li><a href="JavaScript:Void(0);">Leadership</a></li>
                                        <li><a href="JavaScript:Void(0);">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    <div class="container">
                        <div class="row align-items-center justify-content-between">

                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <p class="mb-0">© 2024 ExamWaves - Designed by <a href="genuineict.com">Genuine ICT</a>.</p>
                            </div>

                            {{-- <div class="col-xl-8 col-lg-7 col-md-7">
                                <div class="job-info-count-group">
                                    <div class="single-jb-info-count">
                                        <div class="jbs-y7"><h5 class="ctr">12</h5><span class="theme-2-cl">K</span></div>
                                        <div class="jbs-y5"><p>Active users</p></div>
                                    </div>
                                    <div class="single-jb-info-count">
                                        <div class="jbs-y7"><h5 class="ctr">10</h5><span class="theme-2-cl">M</span></div>
                                        <div class="jbs-y5"><p>Happy Customers</p></div>
                                    </div>
                                    <div class="single-jb-info-count">
                                        <div class="jbs-y7"><h5 class="ctr">76</h5><span class="theme-2-cl">K</span></div>
                                        <div class="jbs-y5"><p>Followers</p></div>
                                    </div>
                                    <div class="single-jb-info-count">
                                        <div class="jbs-y7"><h5 class="ctr">200</h5><span class="theme-2-cl">+</span></div>
                                        <div class="jbs-y5"><p>Companies</p></div>
                                    </div>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </footer>
            <!-- Footer End -->
            @else
            <!-- Footer Start -->
            <footer class="footer skin-light-footer">
                <div>
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-3 col-md-4">
                                <div class="footer-widget">
                                    <img src="assets/img/logo.png" class="img-footer" alt="">
                                    <div class="footer-add">
                                        <p>Address 1<br>Address 2</p>
                                    </div>
                                    <div class="foot-socials">
                                        <ul>
                                            <li><a href="JavaScript:Void(0);"><i class="fa-brands fa-facebook"></i></a></li>
                                            <li><a href="JavaScript:Void(0);"><i class="fa-brands fa-linkedin"></i></a></li>
                                            <li><a href="JavaScript:Void(0);"><i class="fa-brands fa-google-plus"></i></a></li>
                                            <li><a href="JavaScript:Void(0);"><i class="fa-brands fa-twitter"></i></a></li>
                                            <li><a href="JavaScript:Void(0);"><i class="fa-brands fa-dribbble"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-4">
                                <div class="footer-widget">
                                    <h4 class="widget-title font--bold">For Clients</h4>
                                    <ul class="footer-menu">
                                        <li><a href="JavaScript:Void(0);">Talent Marketplace</a></li>
                                        <li><a href="JavaScript:Void(0);">Payroll Services</a></li>
                                        <li><a href="JavaScript:Void(0);">Direct Contracts</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-4">
                                <div class="footer-widget">
                                    <h4 class="widget-title">Our Resources</h4>
                                    <ul class="footer-menu">
                                        <li><a href="JavaScript:Void(0);">Free Business tools</a></li>
                                        <li><a href="JavaScript:Void(0);">Affiliate Program</a></li>
                                        <li><a href="JavaScript:Void(0);">Success Stories</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="footer-widget">
                                    <h4 class="widget-title">The Company</h4>
                                    <ul class="footer-menu">
                                        <li><a href="JavaScript:Void(0);">About Us</a></li>
                                        <li><a href="JavaScript:Void(0);">Leadership</a></li>
                                        <li><a href="JavaScript:Void(0);">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    <div class="container">
                        <div class="row align-items-center justify-content-between">

                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <p class="mb-0">© 2024 ExamWaves - Designed by <a href="genuineict.com">Genuine ICT</a>.</p>
                            </div>

                            {{-- <div class="col-xl-8 col-lg-7 col-md-7">
                                <div class="job-info-count-group">
                                    <div class="single-jb-info-count">
                                        <div class="jbs-y7"><h5 class="ctr">12</h5><span class="theme-2-cl">K</span></div>
                                        <div class="jbs-y5"><p>Active users</p></div>
                                    </div>
                                    <div class="single-jb-info-count">
                                        <div class="jbs-y7"><h5 class="ctr">10</h5><span class="theme-2-cl">M</span></div>
                                        <div class="jbs-y5"><p>Happy Customers</p></div>
                                    </div>
                                    <div class="single-jb-info-count">
                                        <div class="jbs-y7"><h5 class="ctr">76</h5><span class="theme-2-cl">K</span></div>
                                        <div class="jbs-y5"><p>Followers</p></div>
                                    </div>
                                    <div class="single-jb-info-count">
                                        <div class="jbs-y7"><h5 class="ctr">200</h5><span class="theme-2-cl">+</span></div>
                                        <div class="jbs-y5"><p>Companies</p></div>
                                    </div>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </footer>
            <!-- Footer End -->
            @endauth
        </div>


        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
		<script src="{{ asset('assets/js/popper.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
		<script src="{{ asset('assets/js/rangeslider.js') }}"></script>
		<script src="{{ asset('assets/js/slick.js') }}"></script>
		<script src="{{ asset('assets/js/counterup.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
		<script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
		<script src="{{ asset('assets/js/shuffle.min.js') }}"></script>
		<script src="{{ asset('assets/js/wow.js') }}"></script>
		<script src="{{ asset('assets/js/lunar.js') }}"></script>
        <script src="{{ asset('assets/js/summernote/summernote-lite.min.js') }}"></script>

		<script src="{{ asset('assets/js/custom.js') }}"></script>

		<!-- Morris.js charts -->
		<script src="{{ asset('assets/js/raphael/raphael.min.js') }}"></script>
		<script src="{{ asset('assets/js/morris.js/morris.min.js') }}"></script>
		<!-- Custom Chart JavaScript -->
		<script src="{{ asset('assets/js/custom/dashboard.js') }}"></script>

        @stack('scripts')

        @livewireScripts
    </body>
</html>
