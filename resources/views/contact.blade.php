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
        <section class="bg-light-info">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10 col-md-12 text-center">
                        <h1>Lets Talk<span class="text-danger">.</span></h1>
                        <p class="m-0">Cicero famously orated against his political voluptatem accusantium doloremque laudantium opponent Lucius Sergius Catilina. Occasionally the first Oration against Catiline is taken for type specimens</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
        <!-- ============================ Contact Us End ================================== -->


        <!-- ============================ Contact Us ================================== -->
        <section class="pt-0 position-relative">
            <div class="position-absolute top-0 start-0 end-0 bg-light-info ht-200"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="card border-0 rounded-4 p-4 shadow">
                            <div class="row">

                                <div class="col-xl-5 col-lg-5 col-md-5">
                                    <div class="p-4 bg-info rounded-3 h-100">
                                        <h2 class="h4 text-light fw-bold mb-4">Get In Touch</h2>
                                        <p class="text-light opacity-75">Reach out to us for any request or questions.</p>
                                        <ul class="p-0 m-0 mt-4">
                                            {{-- <li class="d-flex mb-3">
                                                <i class="fa-solid fa-phone text-light fs-5 me-3"></i>
                                                <a class="text-light" href="tel:+918564652932">Call Us<br><span class="fw-semibold">+72 8564 652 932</span></a>
                                            </li> --}}
                                            <li class="d-flex mb-3">
                                                <i class="fa-solid fa-envelope-circle-check fs-5 text-light me-3"></i>
                                                <a class="text-light" href="mailto:support@examwaves.com">Drop Us Mail<br><span class="fw-semibold">support@examwaves.com</span></a>
                                            </li>
                                            {{-- <li class="d-flex mb-3">
                                                <i class="fa-solid fa-location-pin text-light fs-5 me-3"></i>
                                                <span class="text-light">
                                                    <span class="fw-semibold">Reach Us<br>4488 Harter Street Dayton, OH 45402</span>
                                                </span>
                                            </li> --}}
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-xl-7 col-lg-7 col-md-7">
                                    <livewire:pages.frontend.contact-form />
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ============================ Contact Us End ================================== -->

		<!-- Footer Start -->
		<footer class="footer skin-light-footer">
			<div>
				<div class="container">
					<div class="row">

						<div class="col-lg-3 col-md-4">
							<div class="footer-widget">
								<img src="{{ asset('assets/img/logo.png') }}" class="img-footer" alt="">
								<div class="footer-add">
									<p>A subsidiary of Complete IT Solutions Ltd.</p>
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
							<p class="mb-0">© 2024 Powered by ExamWaves - Developed by <a href="genuineict.com">Genuine ICT</a>.</p>
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
