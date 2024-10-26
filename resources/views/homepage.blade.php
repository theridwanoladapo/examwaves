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
							<h1 class="mb-4">Fast-Track Your Next Certification <br> Exam Success</h1>
							<p class="fs-5 fw-normal fs-mob">
                                Updated Actual Exam Materials. <br>
                                Instant Access - No NEED for VCE or ETE test engine. <br>
                                Expert-Crafted Answers. <br>
                                Achieve a 99.6% Success Rate.
                            </p>
						</div>
					</div>

					<div class="col-xl-7 col-lg-9 col-md-12 col-sm-12">
						<div class="search-from-clasic mt-5 mb-3">
							<div class="hero-search-content">
                                <form action="{{ route('certifications') }}" method="GET">
                                    {{-- @csrf --}}

                                    <div class="row">
                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
                                            <div class="classic-search-box">
                                                <div class="form-group full">
                                                    <div class="input-with-icon">
                                                        <input type="text" name="search" class="form-control" placeholder="Search for your certification exam...">
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
                                                <button class="btn btn-primary full-width">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

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
                            <h2>Popular Certification Exams</h2>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center justify-content-center row-cols-xl-5 row-cols-lg-4 row-cols-md-4 row-cols-2 g-4">
                    @foreach ($exams as $exam)
                    <div class="col-xl-3">
                        <div class="verticle-blog-wrap bg-white p-2 rounded-2 h-100">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <article>
                                        <a href="{{ route('providers.view', $exam->id) }}">
                                            @if ($exam->image_path)
                                            <img src="{{ asset($exam->image_path) }}" class="img-fluid bg-white p-2" width="100" alt="IMG">
                                            @else
                                            <img src="{{ asset('assets/img/icon.png') }}" class="img-fluid bg-white p-2" width="100" alt="IMG">
                                            @endif
                                        </a>
                                    </article>
                                </div>
                                <div class="col-md-8">
                                    <div class="article-caption py-2 ps-2">
                                        <div class="article-heads mb-3">
                                            <h4 class="font--bold mb-1">{{ $exam->name }}</h4>
                                        </div>
                                        <div class="article-links">
                                            <a href="{{ route('providers.view', $exam->id) }}" class="text-seegreen font--bold">
                                                Explore <i class="fa-solid fa-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

                <div class="row align-items-center justify-content-center mt-5">
                    <div class="col-xl-7 col-lg-7 col-md-11 mb-3 text-center wow animated fadeInUp">
                        <a href="{{ route('providers') }}" class="btn btn-outline-primary rounded-5">View All <i class="fa-solid fa-chevron-right ms-2"></i></a>
                    </div>
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
                                            {{ $certification->title }}
                                            {{ $certification->code ? '('.$certification->code.')' : null }}
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
                        <a href="{{ route('certifications') }}" class="btn btn-outline-primary rounded-5">Explore More Exams <i class="fa-solid fa-chevron-right ms-2"></i></a>
                    </div>
                </div>

			</div>
		</section>
		<div class="clearfix"></div>
		<!-- Latest Exams End -->

        <!-- What Our Customer Says Start -->
		<section>
            <div class="container">

                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-7 col-lg-7 col-md-11 mb-3">
                        <div class="sec-heading text-center">
                            <div class="label text-success bg-light-success d-inline-flex rounded-4 mb-2 font--medium"><span>Our Reviews</span></div>
                            <h2 class="mb-1">What Our Clients Say's</h2>
                            {{-- <p class="test-muted fs-6">At vero eos et accusamus et iusto odio dignissimos ducimus</p> --}}
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-9 col-md-12 col-sm-12">
                        <div class="single-slice" id="single-reviews">

                            <div class="sng-revs-wrap text-center mb-4">
                                <div class="sng-revs-thumber mb-4">
                                    <div class="sng-revs-usrs mb-3">
                                        <figure class="border p-2 mb-0 circle d-inline-flex"><img src="assets/img/user-1.png" class="img-fluid circle" width="90" alt=""></figure>
                                    </div>
                                    <div class="sng-revs-usrcaps">
                                        <h5 class="mb-1">John M.</h5>
                                        {{-- <p class="mb-0 text-muted">CEO of Apple</p> --}}
                                    </div>
                                </div>
                                <div class="sng-revs-desc">
                                    <div class="d-flex justify-content-center fs-6 mb-3">
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-center fs-5 fw-light mb-0">"This platform was a game-changer for me! The practice questions were spot on, and I passed my certification on the first try. Highly recommended for anyone serious about passing fast."</p>
                                    </div>
                                </div>
                            </div>

                            <div class="sng-revs-wrap text-center mb-4">
                                <div class="sng-revs-thumber mb-4">
                                    <div class="sng-revs-usrs mb-3">
                                        <figure class="border p-2 mb-0 circle d-inline-flex"><img src="assets/img/user-2.png" class="img-fluid circle" width="90" alt=""></figure>
                                    </div>
                                    <div class="sng-revs-usrcaps">
                                        <h5 class=" mb-1">Sarah L.</h5>
                                        {{-- <p class="mb-0 text-muted">CEO of Slack</p> --}}
                                    </div>
                                </div>
                                <div class="sng-revs-desc">
                                    <div class="d-flex justify-content-center fs-6 mb-3">
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-center fs-5 fw-light mb-0">"I was nervous about my exam, but the accurate and up-to-date questions here gave me the confidence I needed. I aced my test, and the explanations were super helpful!"</p>
                                    </div>
                                </div>
                            </div>

                            <div class="sng-revs-wrap text-center mb-4">
                                <div class="sng-revs-thumber mb-4">
                                    <div class="sng-revs-usrs mb-3">
                                        <figure class="border p-2 mb-0 circle d-inline-flex"><img src="assets/img/user-3.png" class="img-fluid circle" width="90" alt=""></figure>
                                    </div>
                                    <div class="sng-revs-usrcaps">
                                        <h5 class="mb-1">Michael R.</h5>
                                        {{-- <p class="mb-0 text-muted">Founder of Sloover</p> --}}
                                    </div>
                                </div>
                                <div class="sng-revs-desc">
                                    <div class="d-flex justify-content-center fs-6 mb-3">
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-center fs-5 fw-light mb-0">"Fantastic resource! The instant download feature saved me so much time, and the questions were exactly what I saw on the exam. Can't thank the team enough for helping me pass."</p>
                                    </div>
                                </div>
                            </div>

                            <div class="sng-revs-wrap text-center mb-4">
                                <div class="sng-revs-thumber mb-4">
                                    <div class="sng-revs-usrs mb-3">
                                        <figure class="border p-2 mb-0 circle d-inline-flex"><img src="assets/img/user-4.png" class="img-fluid circle" width="90" alt=""></figure>
                                    </div>
                                    <div class="sng-revs-usrcaps">
                                        <h5 class="mb-1">Emma K.</h5>
                                        {{-- <p class="mb-0 text-muted">CEO of Microtech</p> --}}
                                    </div>
                                </div>
                                <div class="sng-revs-desc">
                                    <div class="d-flex justify-content-center fs-6 mb-3">
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-center fs-5 fw-light mb-0">"I’ve tried other exam prep sites, but this one was by far the best. The expert-verified answers and detailed explanations made all the difference. I passed with flying colors!"</p>
                                    </div>
                                </div>
                            </div>

                            <div class="sng-revs-wrap text-center mb-4">
                                <div class="sng-revs-thumber mb-4">
                                    <div class="sng-revs-usrs mb-3">
                                        <figure class="border p-2 mb-0 circle d-inline-flex"><img src="assets/img/user-5.png" class="img-fluid circle" width="90" alt=""></figure>
                                    </div>
                                    <div class="sng-revs-usrcaps">
                                        <h5 class="mb-1">David S.</h5>
                                        {{-- <p class="mb-0 text-muted">Founder of Bookerg</p> --}}
                                    </div>
                                </div>
                                <div class="sng-revs-desc">
                                    <div class="d-flex justify-content-center fs-6 mb-3">
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                        <i class="fa-solid fa-star text-warning mx-2"></i>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-center fs-5 fw-light mb-0">"This site is the real deal! The practice exams are incredibly accurate, and the 99.6% pass rate isn’t just a claim—it worked for me too. I’ll definitely be using this again for my next certification."</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
		<!-- What Our Customer Says End -->

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

        <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>
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
