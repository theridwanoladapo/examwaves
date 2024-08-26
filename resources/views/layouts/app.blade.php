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
    </head>
    <body class="gray-simple">
        <!-- Preloader -->
        {{-- <div id="preloader">
            <div class="preloader"><span></span><span></span></div>
        </div> --}}

        <div id="main-wrapper">
            <livewire:layout.app-navigation />

            {{ $slot }}

            <button type="button" class="d-lg-none btn btn-md btn-primary w-100 rounded-0 fixed-bottom" data-bs-toggle="offcanvas" data-bs-target="#Sidebaruser">
                <i class="fa-solid fa-filter me-2"></i> Dashboard Navigation
            </button>
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

		<script src="{{ asset('assets/js/custom.js') }}"></script>

		<!-- Morris.js charts -->
		<script src="{{ asset('assets/js/raphael/raphael.min.js') }}"></script>
		<script src="{{ asset('assets/js/morris.js/morris.min.js') }}"></script>
		<!-- Custom Chart JavaScript -->
		<script src="{{ asset('assets/js/custom/dashboard.js') }}"></script>
    </body>
</html>
