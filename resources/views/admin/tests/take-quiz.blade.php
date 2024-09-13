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

<body>

    <div id="main-wrapper">

        <!-- Start Navigation -->
        <div class="header shadow">
            <div class="container">
                <nav id="navigation" class="navigation navigation-landscape">
                    <div class="nav-header">
                        <a class="nav-brand" href="{{ route('home') }}">
                            <img src="{{ asset('assets/img/logo.png') }}" class="logo" alt="">
                        </a>
                        <span class="h6 mb-0 border-start border-2 ps-3">
                            {{ $test->certification->title }} - {{ $test->name }}
                        </span>
                    </div>
                    {{-- <div class="nav-menus-wrapper" style="transition-property: none;">
                            <ul class="nav-menu nav-menu-social align-to-right">
								<li>*
									<a href="JavaScript:Void(0);" data-bs-toggle="modal" data-bs-target="#login"><i class="fas fa-sign-in-alt me-2"></i>Sign In</a>
								</li>
								<li class="list-buttons ms-2">
									<a href="signup.html" class="bg-primary">Resiter Now<i class="fa-regular fa-circle-right ms-2"></i></a>
								</li>
							</ul>
						</div> --}}
                </nav>
            </div>
        </div>
        <!-- End Navigation -->
        <div class="clearfix"></div>

        <section>
            <div class="container">
                <div class="row justify-content-center">

                    <livewire:pages.admin.tests.quiz :test="$test" />

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h2 class="pt-2 pt-sm-3 pt-md-4 pt-lg-5 pb-2">{{ $test->certification->title }} ({{ $test->certification->code }})</h2>
                        {{-- <div class="row row-cols-3 my-3">
                            <div class="col">
                                <div class="h4 text-dark font--bold mb-0"><span class="ctr">{{ test_question_count($test->id) }}</span>
                                </div>
                                <p class="fs-sm mb-0">Total Questions</p>
                            </div>
                        </div> --}}
                        <h6>Description</h6>
                        @if ($test->certification->description)
                        <p class="fs-6">
                            {!! $test->certification->description !!}
                        </p>
                        @endif
                    </div>


                </div>

            </div>
        </section>
        <div class="clearfix"></div>

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
</body>

</html>
