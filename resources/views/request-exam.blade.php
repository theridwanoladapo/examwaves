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

    @livewireStyles
</head>

<body class="font-sans antialiased">
    <!-- Preloader -->
    {{-- <div id="preloader">
        <div class="preloader"><span></span><span></span></div>
    </div> --}}

    <!-- Main wrapper -->
	<div id="main-wrapper">

        <!-- Start Navigation -->
        <livewire:layout.app-navigation />

        <!-- ============================= Contact Us Start ================================== -->
        <section>
            <div class="container">
                <div class="row align-items-center justify-content-between">

                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="d-block position-relative wow animated fadeInLeft">
                            <h2 class="lh-base">Request a New Exam</h2>
                            <p class="animated fadeInLeft">Thank you for your interest in our examination services!</p>
                            <p class="animated fadeInLeft">We strive to offer a comprehensive range of exam to meet your needs.
                                If you do not see the specific exam you are looking for on our website, please let us know.
                            </p>
                            <p class="animated fadeInLeft">We value your feedback and are committed to expanding our offerings based on your requests.
                            </p>
                            <p class="animated fadeInLeft">Please submit a request form below:
                            </p>
                        </div>
                    </div>

                    <div class="col-xl-5 col-lg-6 col-md-6">
                        <div class="position-relative  wow animated fadeInRight">
                            <img src="{{ asset('assets/img/request.png') }}" class="img-fluid" alt="">
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ============================ Contact Us End ================================== -->

        <section class="position-relative bg-dark">
            <div class="position-absolute top-0 start-0 z-0">
                <img src="{{ asset('assets/img/shape-1-soft-light.svg') }}" alt="SVG" width="300">
            </div>
            <div class="position-absolute bottom-0 end-0 me-10 z-0">
                <img src="{{ asset('assets/img/shape-1-soft-light.svg') }}" alt="SVG" width="250">
            </div>
            <div class="container">
                <div class="text-center">
                    <div class="rounded-5 px-3 py-1 font--medium text-light bg-seegreen d-inline-flex justify-content-center m-auto">Request Exam</div>
                </div>
                <h2 class="h1 card-title text-center pb-4 text-light">Send an exam request</h2>
                <livewire:pages.frontend.request-form />
            </div>
        </section>

		<!-- Footer Start -->
		<livewire:layout.app-footer />
		<!-- Footer End -->
    </div>

    <!-- All Jquery -->
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

    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @livewireScripts
</body>

</html>
