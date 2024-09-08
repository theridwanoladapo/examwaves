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
								<li>
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

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row">

                            <div class="col-md-9">
                                <div class="ps-md-4 ps-lg-3 overflow-y-auto border border-3" style="height: 450px">

                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <div class="w-100">
                                                <div class="d-flex justify-content-start">
                                                    <button class="btn btn-sm btn-outline-dark px-3">Back</button>
                                                </div>
                                            </div>
                                            <div class="w-100">
                                                <div class="d-flex justify-content-end">
                                                    <button class="btn btn-sm btn-primary px-3">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <span class="pt-2 pt-sm-3 pt-md-4 pt-lg-5">Question 3 of 90</span>
                                            <h6 class="mt-2">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti, natus quisquam voluptatem itaque sit ratione quibusdam.
                                            </h6>
                                            <div class="pt-4">
                                                <div class="form-check ps-0">
                                                    <label for="flexCheckDefault" class="form-check-label border rounded py-2 w-100 d-flex align-items-center">
                                                        <div class="ms-2 form-check">
                                                            <input type="checkbox" value="" id="flexCheckDefault" class="form-check-input">
                                                        </div>
                                                        <span class="ms-3">
                                                            Corrupti, natus quisquam voluptatem itaque sit ratione quibusdam.Corrupti, natus quisquam voluptatem itaque sit ratione quibusdam.
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="pt-4">
                                                <div class="form-check ps-0">
                                                    <label for="flexRadioDefault1" class="form-check-label border rounded py-2 w-100 d-flex align-items-center">
                                                        <div class="ms-2 form-check">
                                                            <input type="radio" name="flexRadioDefault" id="flexRadioDefault1" class="form-check-input">
                                                        </div>
                                                        <span class="ms-3">
                                                            Corrupti, natus quisquam voluptatem itaque sit ratione quibusdam.Corrupti, natus quisquam voluptatem itaque sit ratione quibusdam.
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="form-check ps-0">
                                                    <label for="flexRadioDefault2" class="form-check-label border rounded py-2 w-100 d-flex align-items-center">
                                                        <div class="ms-2 form-check">
                                                            <input type="radio" name="flexRadioDefault" id="flexRadioDefault2" class="form-check-input">
                                                        </div>
                                                        <span class="ms-3">
                                                            Corrupti, natus quisquam voluptatem itaque sit ratione quibusdam.Corrupti, natus quisquam voluptatem itaque sit ratione quibusdam.
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="form-check ps-0">
                                                    <label for="flexRadioDefault3" class="form-check-label border rounded py-2 w-100 d-flex align-items-center">
                                                        <div class="ms-2 form-check">
                                                            <input type="radio" name="flexRadioDefault" id="flexRadioDefault3" class="form-check-input">
                                                        </div>
                                                        <span class="ms-3">
                                                            Corrupti, natus quisquam voluptatem itaque sit ratione quibusdam.Corrupti, natus quisquam voluptatem itaque sit ratione quibusdam.
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="w-100">
                                                <div class="d-flex justify-content-between">
                                                    <button class="btn btn-sm btn-outline-dark px-3">Back</button>
                                                    <button class="btn btn-sm btn-primary px-3">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>
                                <div></div>
                            </div>

                            <div class="col-md-3">
                                <div class="d-flex d-md-block flex-wrap position-sticky top-0 border border-3 p-2">
                                    <div class="card card-primary">
                                        <div class="card-body">

                                            <span>3/90</span>
                                            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="3" aria-valuemin="1" aria-valuemax="90">
                                                <div class="progress-bar" style="width: 3%"></div>
                                            </div>

                                            <div class="text-left">
                                                <h6 class="text-primary mb-1">Timer:</h6>
                                                <div id="timer" class="h6 bg-light d-flex justify-content-around py-2 px-3 rounded">
                                                    <span id="hours">00</span> <span>:</span>
                                                    <span id="minutes">00</span> <span>:</span>
                                                    <span id="seconds">00</span>
                                                </div>
                                                <button class="btn btn-sm btn-outline-success w-100" id="submit">Finish Test</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h2 class="h1 pt-2 pt-sm-3 pt-md-4 pt-lg-5 pb-2">the Results</h2>
                        <p class="fs-6">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et
                            quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas
                            sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione
                            voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet,
                            consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                            dolore magnam aliquam quaerat voluptatem.</p>
                        <div class="row row-cols-3 pt-2 pt-sm-3 pt-md-4 pt-xl-5 my-3">
                            <div class="col">
                                <div class="h2 display-1 text-dark font--bold mb-0"><span class="ctr">30</span>+
                                </div>
                                <p class="fs-sm mb-0">Total Web templates</p>
                            </div>
                            <div class="col">
                                <div class="h2 display-1 text-dark font--bold mb-0"><span class="ctr">175</span>%
                                </div>
                                <p class="fs-sm mb-0">Revenue Increase</p>
                            </div>
                            <div class="col">
                                <div class="h2 display-1 text-dark font--bold mb-0"><span class="ctr">85</span>M
                                </div>
                                <p class="fs-sm mb-0">Happy Clients in The World</p>
                            </div>
                        </div>
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
