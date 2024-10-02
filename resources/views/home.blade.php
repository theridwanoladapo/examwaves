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

        @auth
        <div class="d-flex align-items-center pb-1 mt-3 mb-2 bg-white w-100">
            <span class="avatar bg-light-primary text-primary w-15 h-15 me-2 ms-4">
                <span class="fs-30">{{ Str::substr(auth()->user()->name, 0, 1) }}</span>
            </span>
            <div class="ps-3">
                <h6 class="mb-0">Welcome back, {{ auth()->user()->name }}</h6>
                {{-- <span class="fs-sm text-muted">02 hours ago</span> --}}
            </div>
        </div>
        @endauth

        <!--  Hero Banner Start -->
        <div class="image-cover hero-header" style="background:#ecf4f9 url({{ asset('assets/img/home-bg.png') }})no-repeat;">
        	<div class="container">

				<div class="row justify-content-center align-items-center">
					<div class="col-xl-9 col-lg-11 col-md-12 col-sm-12">
						<div class="elcoss-excort text-center ">
							<h1 class="mb-4">Pass Your Next Certification <br> Exam Fast</h1>
							<p class="fs-5 fw-normal fs-mob">
                                Real IT Certification Practice Tests. Instant Access. <br>
                                Accurate & Verified Exam Questions & Answers by IT Experts. <br>
                                99.6% Exam Pass Rate.
                            </p>
						</div>
					</div>

					<div class="col-xl-7 col-lg-9 col-md-12 col-sm-12">
						<div class="search-from-clasic mt-5 mb-3">
							<div class="hero-search-content">
                                {{-- <form action="" method="POST"> --}}
                                    <div class="row">
                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
                                            <div class="classic-search-box">
                                                <div class="form-group full">
                                                    <div class="input-with-icon">
                                                        <input type="text" class="form-control" placeholder="Search for your certification exam...">
                                                        <span class="svg-icon text-primary svg-icon-2hx">
                                                            <svg width="23" height="23" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.3" d="M21 11H18.9C18.5 7.9 16 5.49998 13 5.09998V3C13 2.4 12.6 2 12 2C11.4 2 11 2.4 11 3V5.09998C7.9 5.49998 5.50001 8 5.10001 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H5.10001C5.50001 16.1 8 18.4999 11 18.8999V21C11 21.6 11.4 22 12 22C12.6 22 13 21.6 13 21V18.8999C16.1 18.4999 18.5 16 18.9 13H21C21.6 13 22 12.6 22 12C22 11.4 21.6 11 21 11ZM12 17C9.2 17 7 14.8 7 12C7 9.2 9.2 7 12 7C14.8 7 17 9.2 17 12C17 14.8 14.8 17 12 17Z" fill="currentColor"/>
                                                                <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" fill="currentColor"/>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary full-width">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                {{-- </form> --}}
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		<!-- Hero Banner End -->

        <!-- Exams Start -->
        <section>
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-10 col-md-12 col-sm-12 mb-3">
                        <div class="sec-heading center">
                            <div class="d-inline-flex px-4 py-1 rounded-5 text-primary bg-light-primary font--medium mb-2">
                                <span>Exam Providers</span>
                            </div>
                            <h2>Top Exam Providers</h2>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center justify-content-center row-cols-xl-5 row-cols-lg-4 row-cols-md-4 row-cols-2 g-4">
                    @foreach ($exams as $exam)
                    <div class="col">
                        <div class="d-flex align-items-center justify-content-start p-3 rounded-3 border">
                            {{-- <div class="flex-shrink-0"><img src="assets/img/l-1.png" class="img-fluid" width="60" alt=""></div> --}}
                            <div class="ps-3">
                                <h6 class="mb-0">
                                    <a href="{{ route('providers.view', $exam->id) }}" wire:navigate>{{ $exam->name }}</a>
                                </h6>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </section>
        <div class="clearfix"></div>
        <!-- Exams End -->

        <!-- Latest Exams Start -->
		<section class="bg-light-info">
			<div class="container">

				<div class="row align-items-center justify-content-center">
					<div class="col-xl-7 col-lg-7 col-md-11 mb-3">
						<div class="sec-heading text-center">
                            <div class="d-inline-flex px-4 py-1 rounded-5 text-primary bg-light-primary font--medium mb-2"><span>Exams</span></div>
                            <h2 class="mb-1">Latest Exams</h2>
						</div>
					</div>
				</div>

				<div class="row justify-content-center g-lg-4 g-3">
                    @foreach ($certifications as $certification)
					<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
						<div class="card border rounded-4 p-4 h-100 d-flex flex-column">
							<div class="position-relative mb-4">
								<div class="d-flex align-items-center mb-3">
									<div class="dlio-catds">
                                        <h6 class="fw-medium mb-0 text-success bg-light-success rounded px-3 py-1 me-2">
                                            <a href="{{ route('providers.view', $certification->exam->id) }}">{{ $certification->exam->name }}</a>
                                        </h6>
                                    </div>
									{{-- <div class="dlio-dates ms-3"><span class="text-muted">10 March 2023</span></div> --}}
								</div>
								<div class="d-flex">
									<h5 class="lh-base fw-semibold mb-0">
                                        <a href="{{ route('certifications.view', $certification->id) }}" class="jbl-detail">
                                            {{ $certification->title }} ({{ $certification->code }})
                                        </a>
                                    </h5>
								</div>
							</div>
                            <div class="mt-auto">
                                <div class="crd-srv gray-simple d-flex align-items-center justify-content-between px-3 py-3 rounded-3 mt-3">
                                    <div class="empl-thumb">
                                        <h6><span class="fw-semibold mb-0">Practice Exam:</span> {{ exam_test_count($certification->id) }}</h6>
                                        <h6><span class="fw-semibold mb-0">Questions:</span> {{ exam_question_count($certification->id) }}</h6>
                                    </div>
                                    <a href="{{ route('certifications.view', $certification->id) }}" class="btn btn-md btn-primary">See more</a>
                                </div>
                            </div>
						</div>
					</div>
                    @endforeach
				</div>

                <div class="row align-items-center justify-content-center mt-5">
                    <div class="col-xl-7 col-lg-7 col-md-11 mb-3 text-center wow animated fadeInUp">
                        <a href="{{ route('certifications') }}" class="btn btn-outline-primary rounded-5">Explore More Exams</a>
                    </div>
                </div>

			</div>
		</section>
		<div class="clearfix"></div>
		<!-- Latest Exams End -->

        <!-- What Our Customaer Says Start -->
		<section>
			<div class="container">

				<div class="row justify-content-center">
					<div class="col-xl-6 col-lg-7 col-md-10">
						<div class="sec-heading center">
							<div class="label text-primary bg-light-primary d-inline-flex rounded-4 mb-2 font--medium"><span>Our Reviews</span></div>
							<h2>Our Customers Love & Says</h2>
						</div>
					</div>
				</div>

				<div class="row justify-content-center">
					<div class="col-xl-9 col-lg-12 col-md-12">

						<div class="tab-content py-5" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-track-1" role="tabpanel" aria-labelledby="pills-track-1-tab" tabindex="0">
								<div class="text-center">
									<div class="mb-3">
										<p class="m-0 fw-light fs-5">The wise man therefore always circumstances and owing to the claims of duty or the obligations holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.</p>
									</div>
									<div class="position-relative">
										<h5 class="fw-semibold mb-0 lh-base">Chad B. Werner</h5>
										<p class="fw-medium text-primary m-0">Web Designer</p>
									</div>
								</div>
							</div>

							<div class="tab-pane fade" id="pills-track-2" role="tabpanel" aria-labelledby="pills-track-2-tab" tabindex="0">
								<div class="text-center">
									<div class="mb-3">
										<p class="m-0 fw-light fs-5">The wise man therefore always circumstances and owing to the claims of duty or the obligations holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.</p>
									</div>
									<div class="position-relative">
										<h5 class="fw-semibold mb-0 lh-base">Melvin D. Fowler</h5>
										<p class="fw-medium text-primary m-0">Team Manager</p>
									</div>
								</div>
							</div>

							<div class="tab-pane fade" id="pills-track-3" role="tabpanel" aria-labelledby="pills-track-3-tab" tabindex="0">
								<div class="text-center">
									<div class="mb-3">
										<p class="m-0 fw-light fs-5">The wise man therefore always circumstances and owing to the claims of duty or the obligations holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.</p>
									</div>
									<div class="position-relative">
										<h5 class="fw-semibold mb-0 lh-base">Chad B. Werner</h5>
										<p class="fw-medium text-primary m-0">Web Designer</p>
									</div>
								</div>
							</div>

							<div class="tab-pane fade" id="pills-track-4" role="tabpanel" aria-labelledby="pills-track-4-tab" tabindex="0">
								<div class="text-center">
									<div class="mb-3">
										<p class="m-0 fw-light fs-5">The wise man therefore always circumstances and owing to the claims of duty or the obligations holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.</p>
									</div>
									<div class="position-relative">
										<h5 class="fw-semibold mb-0 lh-base">Sylvester B. Blevins</h5>
										<p class="fw-medium text-primary m-0">WordPress Developer</p>
									</div>
								</div>
							</div>


							<div class="tab-pane fade" id="pills-track-5" role="tabpanel" aria-labelledby="pills-track-5-tab" tabindex="0">
								<div class="text-center">
									<div class="mb-3">
										<p class="m-0 fw-light fs-5">The wise man therefore always circumstances and owing to the claims of duty or the obligations holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.</p>
									</div>
									<div class="position-relative">
										<h5 class="fw-semibold mb-0 lh-base">Jacob R. Haynes</h5>
										<p class="fw-medium text-primary m-0">Sr. PHP Developer</p>
									</div>
								</div>
							</div>
						</div>

						<ul class="nav nav-pills mt-3 text-center align-items-center justify-content-center" id="pills-tab" role="tablist">
							<li class="nav-item p-2" role="presentation">
								<a class="m-0 active" href="#" id="pills-track-1-tab" data-bs-toggle="pill" data-bs-target="#pills-track-1" type="button" role="tab" aria-controls="pills-track-1" aria-selected="true">
                                    <div class="p-2 border border-3 circle licroobr">
                                        <img src="{{ asset('assets/img/team-1.jpg') }}" class="img-fluid circle" width="80" alt="">
                                    </div>
                                </a>
							</li>
							<li class="nav-item p-2" role="presentation">
								<a class="m-0" href="#" id="pills-track-2-tab" data-bs-toggle="pill" data-bs-target="#pills-track-2" type="button" role="tab" aria-controls="pills-track-2" aria-selected="false">
                                    <div class="p-2 border border-3 circle licroobr">
                                        <img src="{{ asset('assets/img/team-2.jpg') }}" class="img-fluid circle" width="80" alt="">
                                    </div>
                                </a>
							</li>
							<li class="nav-item p-2" role="presentation">
								<a class="m-0" href="#" id="pills-track-3-tab" data-bs-toggle="pill" data-bs-target="#pills-track-3" type="button" role="tab" aria-controls="pills-track-3" aria-selected="false">
                                    <div class="p-2 border border-3 circle licroobr">
                                        <img src="{{ asset('assets/img/team-3.jpg') }}" class="img-fluid circle" width="80" alt="">
                                    </div>
                                </a>
							</li>
							<li class="nav-item p-2" role="presentation">
								<a class="m-0" href="#" id="pills-track-4-tab" data-bs-toggle="pill" data-bs-target="#pills-track-4" type="button" role="tab" aria-controls="pills-track-4" aria-selected="false">
                                    <div class="p-2 border border-3 circle licroobr">
                                        <img src="{{ asset('assets/img/team-5.jpg') }}" class="img-fluid circle" width="80" alt="">
                                    </div>
                                </a>
							</li>
							<li class="nav-item p-2" role="presentation">
								<a class="m-0" href="#" id="pills-track-5-tab" data-bs-toggle="pill" data-bs-target="#pills-track-5" type="button" role="tab" aria-controls="pills-track-5" aria-selected="false">
                                    <div class="p-2 border border-3 circle licroobr">
                                        <img src="{{ asset('assets/img/team-6.jpg') }}" class="img-fluid circle" width="80" alt="">
                                    </div>
                                </a>
							</li>
						</ul>

					</div>
				</div>

			</div>
		</section>
		<!-- What Our Customaer Says End -->

        <!-- Call To Action -->
		<section class="bg-cover call-action-container bg-primary position-relative">
			<div class="position-absolute top-0 end-0 z-0">
				<img src="{{ asset('assets/img/alert-bg.png') }}" alt="SVG" width="300">
			</div>
			<div class="position-absolute bottom-0 start-0 me-10 z-0">
				<img src="{{ asset('assets/img/circle.png') }}" alt="SVG" width="150">
			</div>
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-xl-7 col-lg-10 col-md-12 col-sm-12">

						<div class="call-action-wrap">
							<div class="call-action-caption">
								<h2 class="text-light">Are You Already Working With Us?</h2>
								<p class="text-light fs-5 fw-light">Deleniti corrupti quos dolores et quas molestias</p>
							</div>
							<div class="call-action-form">
								<form>
									<div class="newsltr-form rounded-3">
										<input type="text" class="form-control" placeholder="Search for your certification exam...">
										<button type="button" class="btn btn-dark">Search</button>
									</div>
								</form>
							</div>
						</div>

					</div>
				</div>
			</div>
		</section>
		<!-- Call To Action End -->

		<!-- Footer Start -->
		<footer class="footer skin-light-footer">
			<div>
				<div class="container">
					<div class="row">

						<div class="col-lg-3 col-md-4">
							<div class="footer-widget">
								<img src="{{ asset('assets/img/logo.png') }}" class="img-footer" alt="">
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

					</div>
				</div>
			</div>
		</footer>
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
