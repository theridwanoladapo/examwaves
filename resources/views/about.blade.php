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
        <section class="bg-cover gray py-4">
            <div class="container">
                <div class="row align-items-center justify-content-between">

                    <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                        <h1 class="fw-semibold mb-4">About Us</h1>
                        <p>At ExamWaves, our mission is simple: to provide an affordable and user-friendly platform for exam preparation. We believe that success shouldn’t come with a hefty price tag, and we’re here to help you overcome the overpriced services of other exam prep providers.</p>
                        <p>We offer accurate, expert-verified practice questions that give you everything you need to pass your exams—without relying on expensive, outdated VCE test engines. Whether you’re pursuing IT certifications or professional qualifications, ExamWaves is designed to empower you with the tools and confidence to succeed, all at a fraction of the cost.</p>
                        <p>Your success is our priority, and we’re committed to delivering quality without the greed. Welcome to a smarter, more affordable way to prepare!</p>
                        <div class="d-flex align-items-center mt-4">
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-12 col-xl-offset-1">
                        <div class="service-thumb position-relative mt-md-0 mt-3">
                            <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" alt="img">
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ============================ Contact Us End ================================== -->

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
								<h2 class="text-light">We'd love to hear about your experience!</h2>
								<p class="text-light fs-5 fw-light">Leave a comment and let us know your thoughts — we always enjoy hearing from our customers.</p>
							</div>
							<div class="call-action-form">
                                <div class="newsltr-form rounded-3">
                                    <input type="text" class="form-control" id="comment" placeholder="Leave a comment...">
                                    <button type="button" onclick="submitComment()" class="btn btn-dark">Submit</button>
                                </div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</section>
		<!-- Call To Action End -->

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
    <script>
        function submitComment() {
            let comment = document.querySelector("#comment");
            if (comment.value != '') {
                alert('Your comment has been submitted successfully.');
            }
            comment.value = '';
        }
    </script>

    @livewireScripts
</body>

</html>
