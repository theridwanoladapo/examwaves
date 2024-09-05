<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/Jost.css" type="text/css">
    <link href="assets/css/styles.css" rel="stylesheet">
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
        <div class="image-cover hero-header" style="background:#ecf4f9 url(assets/img/home-bg.png)no-repeat;">
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
                                <form action="" method="POST">
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
                                                <button type="submit" class="btn btn-primary full-width">Search</button>
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
                                            <a href="javascript:void(0)">{{ $certification->exam->name }}</a>
                                        </h6>
                                    </div>
									{{-- <div class="dlio-dates ms-3"><span class="text-muted">10 March 2023</span></div> --}}
								</div>
								<div class="d-flex">
									<h5 class="lh-base fw-semibold mb-0">
                                        <a href="javascript:void(0)" class="jbl-detail">
                                            {{ $certification->title }} ({{ $certification->code }})
                                        </a>
                                    </h5>
								</div>
							</div>
                            <div class="mt-auto">
                                <div class="crd-srv gray-simple d-flex align-items-center justify-content-between px-3 py-3 rounded-3 mt-3">
                                    <div class="empl-thumb">
                                        <h6><span class="fw-semibold mb-0">Practice Exam:</span> {{ exam_test_count($certification->id) }}</h6>
                                        <h6><span class="fw-semibold mb-0">Question Exam:</span> {{ exam_question_count($certification->id) }}</h6>
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

        <!-- Our Partners Start -->
		{{-- <section class="py-5">
			<div class="container">

				<div class="row row-cols-4 row-cols-md-6 align-items-center justify-content-center gx-4">
					<div class="col">
						<figure class="single-brand thumb-figure p-xl-4 p-lg-3 p-md-2 py-3">
							<img src="assets/img/brand/logo-1.png" class="img-fluid" alt="">
						</figure>
					</div>

					<div class="col">
						<figure class="single-brand thumb-figure p-xl-4 p-lg-3 p-md-2 py-3">
							<img src="assets/img/brand/logo-2.png" class="img-fluid" alt="">
						</figure>
					</div>

					<div class="col">
						<figure class="single-brand thumb-figure p-xl-4 p-lg-3 p-md-2 py-3">
							<img src="assets/img/brand/logo-3.png" class="img-fluid" alt="">
						</figure>
					</div>

					<div class="col">
						<figure class="single-brand thumb-figure p-xl-4 p-lg-3 p-md-2 py-3">
							<img src="assets/img/brand/logo-4.png" class="img-fluid" alt="">
						</figure>
					</div>

					<div class="col">
						<figure class="single-brand thumb-figure p-xl-4 p-lg-3 p-md-2 py-3">
							<img src="assets/img/brand/logo-8.png" class="img-fluid" alt="">
						</figure>
					</div>

					<div class="col">
						<figure class="single-brand thumb-figure p-xl-4 p-lg-3 p-md-2 py-3">
							<img src="assets/img/brand/logo-9.png" class="img-fluid" alt="">
						</figure>
					</div>

				</div>

			</div>
		</section>
		<div class="clearfix"></div> --}}
		<!-- Our Partners End -->

        <!-- Exam Category Start -->
		{{-- <section class="bg-light-info">
			<div class="container">

				<div class="row align-items-center justify-content-center">
					<div class="col-xl-7 col-lg-7 col-md-11 mb-3">
						<div class="sec-heading text-center">
							<div class="label text-success bg-light-success d-inline-flex rounded-4 mb-2 font--medium"><span>Hot categories</span></div>
							<h2 class="mb-1">Most Popular & Hot Categories</h2>
							<p class="test-muted fs-6">At vero eos et accusamus et iusto odio dignissimos ducimus</p>
							</div>
					</div>
				</div>

				<div class="row justify-content-center g-4">

					<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
						<div class="card border-0 rounded-4 p-4 h-100">
							<div class="position-relative mb-3">
								<div class="square--50 circle border">
									<span class="svg-icon text-primary svg-icon-2hx">
										<svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path opacity="0.3" d="M16.163 17.55C17.0515 16.6633 17.6785 15.5488 17.975 14.329C18.2389 13.1884 18.8119 12.1425 19.631 11.306L12.694 4.36902C11.8574 5.18796 10.8115 5.76088 9.67099 6.02502C8.15617 6.3947 6.81277 7.27001 5.86261 8.50635C4.91245 9.74268 4.41238 11.266 4.44501 12.825C4.46196 13.6211 4.31769 14.4125 4.0209 15.1515C3.72412 15.8905 3.28092 16.5617 2.71799 17.125L2.28699 17.556C2.10306 17.7402 1.99976 17.9897 1.99976 18.25C1.99976 18.5103 2.10306 18.7598 2.28699 18.944L5.06201 21.719C5.24614 21.9029 5.49575 22.0062 5.75601 22.0062C6.01627 22.0062 6.26588 21.9029 6.45001 21.719L6.88101 21.288C7.44427 20.725 8.11556 20.2819 8.85452 19.9851C9.59349 19.6883 10.3848 19.5441 11.181 19.561C12.1042 19.58 13.0217 19.4114 13.878 19.0658C14.7343 18.7201 15.5116 18.2046 16.163 17.55Z" fill="currentColor"/>
											<path d="M19.631 11.306L12.694 4.36902L14.775 2.28699C14.9591 2.10306 15.2087 1.99976 15.469 1.99976C15.7293 1.99976 15.9789 2.10306 16.163 2.28699L21.713 7.83704C21.8969 8.02117 22.0002 8.27075 22.0002 8.53101C22.0002 8.79126 21.8969 9.04085 21.713 9.22498L19.631 11.306ZM13.041 10.959C12.6427 10.5604 12.1194 10.3112 11.5589 10.2532C10.9985 10.1952 10.4352 10.332 9.96375 10.6405C9.4923 10.949 9.14148 11.4105 8.97034 11.9473C8.79919 12.4841 8.81813 13.0635 9.02399 13.588L2.98099 19.631L4.36899 21.019L10.412 14.975C10.9364 15.1816 11.5161 15.2011 12.0533 15.0303C12.5904 14.8594 13.0523 14.5086 13.361 14.037C13.6697 13.5654 13.8065 13.0018 13.7482 12.4412C13.6899 11.8805 13.4401 11.357 13.041 10.959Z" fill="currentColor"/>
										</svg>
									</span>
								</div>
							</div>
							<div class="crd-srv mb-3">
								<h5 class="fw-semibold lh-base mb-2"><a href="JavaScript:Void(0);">Design & Development</a></h5>
								<p class="mb-0">1750 Active Jobs</p>
							</div>
						</div>
					</div>

					<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
						<div class="card border-0 rounded-4 p-4 h-100">
							<div class="position-relative mb-3">
								<div class="square--50 circle border">
									<span class="svg-icon text-primary svg-icon-2hx">
										<svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="currentColor"/>
											<path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="currentColor"/>
										</svg>
									</span>
								</div>
							</div>
							<div class="crd-srv mb-3">
								<h5 class="fw-semibold lh-base mb-2"><a href="JavaScript:Void(0);">Business & Marketing</a></h5>
								<p class="mb-0">1750 Active Jobs</p>
							</div>
						</div>
					</div>

					<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
						<div class="card border-0 rounded-4 p-4 h-100">
							<div class="position-relative mb-3">
								<div class="square--50 circle border">
									<span class="svg-icon text-primary svg-icon-2hx">
										<svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M20 19.725V18.725C20 18.125 19.6 17.725 19 17.725H5C4.4 17.725 4 18.125 4 18.725V19.725H3C2.4 19.725 2 20.125 2 20.725V21.725H22V20.725C22 20.125 21.6 19.725 21 19.725H20Z" fill="currentColor"/>
											<path opacity="0.3" d="M22 6.725V7.725C22 8.325 21.6 8.725 21 8.725H18C18.6 8.725 19 9.125 19 9.725C19 10.325 18.6 10.725 18 10.725V15.725C18.6 15.725 19 16.125 19 16.725V17.725H15V16.725C15 16.125 15.4 15.725 16 15.725V10.725C15.4 10.725 15 10.325 15 9.725C15 9.125 15.4 8.725 16 8.725H13C13.6 8.725 14 9.125 14 9.725C14 10.325 13.6 10.725 13 10.725V15.725C13.6 15.725 14 16.125 14 16.725V17.725H10V16.725C10 16.125 10.4 15.725 11 15.725V10.725C10.4 10.725 10 10.325 10 9.725C10 9.125 10.4 8.725 11 8.725H8C8.6 8.725 9 9.125 9 9.725C9 10.325 8.6 10.725 8 10.725V15.725C8.6 15.725 9 16.125 9 16.725V17.725H5V16.725C5 16.125 5.4 15.725 6 15.725V10.725C5.4 10.725 5 10.325 5 9.725C5 9.125 5.4 8.725 6 8.725H3C2.4 8.725 2 8.325 2 7.725V6.725L11 2.225C11.6 1.925 12.4 1.925 13.1 2.225L22 6.725ZM12 3.725C11.2 3.725 10.5 4.425 10.5 5.225C10.5 6.025 11.2 6.725 12 6.725C12.8 6.725 13.5 6.025 13.5 5.225C13.5 4.425 12.8 3.725 12 3.725Z" fill="currentColor"/>
										</svg>
									</span>
								</div>
							</div>
							<div class="crd-srv mb-3">
								<h5 class="fw-semibold lh-base mb-2"><a href="JavaScript:Void(0);">Business Development</a></h5>
								<p class="mb-0">1750 Active Jobs</p>
							</div>
						</div>
					</div>

					<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
						<div class="card border-0 rounded-4 p-4 h-100">
							<div class="position-relative mb-3">
								<div class="square--50 circle border">
									<span class="svg-icon text-primary s svg-icon-2hx">
										<svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M10.613 16.163L7.837 13.387C7.65313 13.203 7.54983 12.9536 7.54983 12.6935C7.54983 12.4334 7.65313 12.184 7.837 12L14.775 5.06201C14.9589 4.87814 15.2084 4.7749 15.4685 4.7749C15.7286 4.7749 15.978 4.87814 16.162 5.06201L18.938 7.83801C19.1219 8.02197 19.2252 8.2714 19.2252 8.53149C19.2252 8.79159 19.1219 9.04102 18.938 9.22498L12 16.163C11.816 16.3468 11.5666 16.4502 11.3065 16.4502C11.0464 16.4502 10.797 16.3468 10.613 16.163ZM4.71301 17.203L2.48498 20.322C2.3675 20.4863 2.31218 20.687 2.32879 20.8883C2.3454 21.0896 2.43288 21.2784 2.57571 21.4213C2.71853 21.5641 2.90743 21.6516 3.10873 21.6682C3.31003 21.6848 3.51067 21.6294 3.67498 21.512L6.794 19.2841L4.71301 17.203Z" fill="currentColor"/>
											<path opacity="0.3" d="M7.83701 12L2.28699 6.44995C2.10306 6.26582 1.99976 6.01624 1.99976 5.75598C1.99976 5.49572 2.10306 5.24614 2.28699 5.06201L5.06201 2.28699C5.24614 2.10306 5.49575 1.99976 5.75601 1.99976C6.01627 1.99976 6.26588 2.10306 6.45001 2.28699L12 7.83704L7.83701 12ZM18.937 21.713L21.712 18.938C21.8959 18.7539 21.9992 18.5043 21.9992 18.244C21.9992 17.9838 21.8959 17.7342 21.712 17.55L16.162 12L12 16.163L17.55 21.713C17.7341 21.8969 17.9837 22.0002 18.244 22.0002C18.5042 22.0002 18.7539 21.8969 18.938 21.713H18.937ZM9.146 21.634C9.25064 21.7386 9.37833 21.8172 9.51883 21.8636C9.65933 21.9101 9.80874 21.923 9.95511 21.9014C10.1015 21.8797 10.2407 21.824 10.3618 21.7389C10.4828 21.6537 10.5822 21.5415 10.652 21.411C11.0778 20.2848 11.1695 19.0596 10.9161 17.8826C10.6628 16.7055 10.0752 15.6265 9.22385 14.7751C8.37248 13.9238 7.29352 13.3362 6.11646 13.0829C4.93939 12.8296 3.71424 12.9213 2.58801 13.347C2.45756 13.4169 2.34528 13.5162 2.26013 13.6372C2.17499 13.7582 2.11933 13.8976 2.09766 14.0439C2.07598 14.1903 2.08889 14.3397 2.13531 14.4802C2.18174 14.6207 2.26038 14.7484 2.36499 14.853L9.146 21.634ZM19.181 6.83398C19.3013 6.79376 19.4094 6.72347 19.495 6.62976C19.5806 6.53605 19.6408 6.42209 19.6699 6.29858C19.6991 6.17508 19.6962 6.04615 19.6615 5.92407C19.6269 5.802 19.5616 5.69074 19.472 5.60095L18.401 4.53003C18.3112 4.44036 18.2 4.37509 18.0779 4.34045C17.9559 4.30582 17.827 4.30288 17.7035 4.33203C17.58 4.36118 17.4659 4.42139 17.3722 4.50696C17.2785 4.59252 17.2082 4.7007 17.168 4.82104L16.855 5.75903L18.243 7.14697L19.181 6.83398Z" fill="currentColor"/>
										</svg>
									</span>
								</div>
							</div>
							<div class="crd-srv mb-3">
								<h5 class="fw-semibold lh-base mb-2"><a href="JavaScript:Void(0);">Art & Animations</a></h5>
								<p class="mb-0">1750 Active Jobs</p>
							</div>
						</div>
					</div>

					<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
						<div class="card border-0 rounded-4 p-4 h-100">
							<div class="position-relative mb-3">
								<div class="square--50 circle border">
									<span class="svg-icon text-primary svg-icon-2hx">
										<svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M16.95 18.9688C16.75 18.9688 16.55 18.8688 16.35 18.7688C15.85 18.4688 15.75 17.8688 16.05 17.3688L19.65 11.9688L16.05 6.56876C15.75 6.06876 15.85 5.46873 16.35 5.16873C16.85 4.86873 17.45 4.96878 17.75 5.46878L21.75 11.4688C21.95 11.7688 21.95 12.2688 21.75 12.5688L17.75 18.5688C17.55 18.7688 17.25 18.9688 16.95 18.9688ZM7.55001 18.7688C8.05001 18.4688 8.15 17.8688 7.85 17.3688L4.25001 11.9688L7.85 6.56876C8.15 6.06876 8.05001 5.46873 7.55001 5.16873C7.05001 4.86873 6.45 4.96878 6.15 5.46878L2.15 11.4688C1.95 11.7688 1.95 12.2688 2.15 12.5688L6.15 18.5688C6.35 18.8688 6.65 18.9688 6.95 18.9688C7.15 18.9688 7.35001 18.8688 7.55001 18.7688Z" fill="currentColor"/>
											<path opacity="0.3" d="M10.45 18.9687C10.35 18.9687 10.25 18.9687 10.25 18.9687C9.75 18.8687 9.35 18.2688 9.55 17.7688L12.55 5.76878C12.65 5.26878 13.25 4.8687 13.75 5.0687C14.25 5.1687 14.65 5.76878 14.45 6.26878L11.45 18.2688C11.35 18.6688 10.85 18.9687 10.45 18.9687Z" fill="currentColor"/>
										</svg>
									</span>
								</div>
							</div>
							<div class="crd-srv mb-3">
								<h5 class="fw-semibold lh-base mb-2"><a href="JavaScript:Void(0);">Code & Programing</a></h5>
								<p class="mb-0">1750 Active Jobs</p>
							</div>
						</div>
					</div>

					<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
						<div class="card border-0 rounded-4 p-4 h-100">
							<div class="position-relative mb-3">
								<div class="square--50 circle border">
									<span class="svg-icon text-primary svg-icon-2hx">
										<svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path opacity="0.3" d="M18 22C19.7 22 21 20.7 21 19C21 18.5 20.9 18.1 20.7 17.7L15.3 6.30005C15.1 5.90005 15 5.5 15 5C15 3.3 16.3 2 18 2H6C4.3 2 3 3.3 3 5C3 5.5 3.1 5.90005 3.3 6.30005L8.7 17.7C8.9 18.1 9 18.5 9 19C9 20.7 7.7 22 6 22H18Z" fill="currentColor"/>
											<path d="M18 2C19.7 2 21 3.3 21 5H9C9 3.3 7.7 2 6 2H18Z" fill="currentColor"/>
											<path d="M9 19C9 20.7 7.7 22 6 22C4.3 22 3 20.7 3 19H9Z" fill="currentColor"/>
										</svg>
									</span>
								</div>
							</div>
							<div class="crd-srv mb-3">
								<h5 class="fw-semibold lh-base mb-2"><a href="JavaScript:Void(0);">Health & Insurance</a></h5>
								<p class="mb-0">1750 Active Jobs</p>
							</div>
						</div>
					</div>

					<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
						<div class="card border-0 rounded-4 p-4 h-100">
							<div class="position-relative mb-3">
								<div class="square--50 circle border">
									<span class="svg-icon text-primary svg-icon-2hx">
										<svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M17.302 11.35L12.002 20.55H21.202C21.802 20.55 22.202 19.85 21.902 19.35L17.302 11.35Z" fill="currentColor"/>
											<path opacity="0.3" d="M12.002 20.55H2.802C2.202 20.55 1.80202 19.85 2.10202 19.35L6.70203 11.45L12.002 20.55ZM11.302 3.45L6.70203 11.35H17.302L12.702 3.45C12.402 2.85 11.602 2.85 11.302 3.45Z" fill="currentColor"/>
										</svg>
									</span>
								</div>
							</div>
							<div class="crd-srv mb-3">
								<h5 class="fw-semibold lh-base mb-2"><a href="JavaScript:Void(0);">Video Editing & 3D Work</a></h5>
								<p class="mb-0">1750 Active Jobs</p>
							</div>
						</div>
					</div>

					<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
						<div class="card border-0 rounded-4 p-4 h-100 bg-primary">
							<div class="position-relative mb-3">
								<h3 class="text-light lh-base fw-semibold mb-0"><span class="ctr">17</span>K</h3>
								<p class="mb-0 text-light opacity-75">140 More categories</p>
							</div>
							<div class="crd-srv mb-3">
								<a href="#" class="square--50 circle bg-white">
									<span class="svg-icon text-primary svg-icon-2hx">
										<svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M17.8 8.79999L13 13.6L9.7 10.3C9.3 9.89999 8.7 9.89999 8.3 10.3L2.3 16.3C1.9 16.7 1.9 17.3 2.3 17.7C2.5 17.9 2.7 18 3 18C3.3 18 3.5 17.9 3.7 17.7L9 12.4L12.3 15.7C12.7 16.1 13.3 16.1 13.7 15.7L19.2 10.2L17.8 8.79999Z" fill="currentColor"/>
											<path opacity="0.3" d="M22 13.1V7C22 6.4 21.6 6 21 6H14.9L22 13.1Z" fill="currentColor"/>
										</svg>
									</span>
								</a>
							</div>
						</div>
					</div>

				</div>

			</div>
		</section>
		<div class="clearfix"></div> --}}
		<!-- Exam Category End -->

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
								<a class="m-0 active" href="#" id="pills-track-1-tab" data-bs-toggle="pill" data-bs-target="#pills-track-1" type="button" role="tab" aria-controls="pills-track-1" aria-selected="true"><div class="p-2 border border-3 circle licroobr"><img src="assets/img/team-1.jpg" class="img-fluid circle" width="80" alt=""></div></a>
							</li>
							<li class="nav-item p-2" role="presentation">
								<a class="m-0" href="#" id="pills-track-2-tab" data-bs-toggle="pill" data-bs-target="#pills-track-2" type="button" role="tab" aria-controls="pills-track-2" aria-selected="false"><div class="p-2 border border-3 circle licroobr"><img src="assets/img/team-2.jpg" class="img-fluid circle" width="80" alt=""></div></a>
							</li>
							<li class="nav-item p-2" role="presentation">
								<a class="m-0" href="#" id="pills-track-3-tab" data-bs-toggle="pill" data-bs-target="#pills-track-3" type="button" role="tab" aria-controls="pills-track-3" aria-selected="false"><div class="p-2 border border-3 circle licroobr"><img src="assets/img/team-3.jpg" class="img-fluid circle" width="80" alt=""></div></a>
							</li>
							<li class="nav-item p-2" role="presentation">
								<a class="m-0" href="#" id="pills-track-4-tab" data-bs-toggle="pill" data-bs-target="#pills-track-4" type="button" role="tab" aria-controls="pills-track-4" aria-selected="false"><div class="p-2 border border-3 circle licroobr"><img src="assets/img/team-5.jpg" class="img-fluid circle" width="80" alt=""></div></a>
							</li>
							<li class="nav-item p-2" role="presentation">
								<a class="m-0" href="#" id="pills-track-5-tab" data-bs-toggle="pill" data-bs-target="#pills-track-5" type="button" role="tab" aria-controls="pills-track-5" aria-selected="false"><div class="p-2 border border-3 circle licroobr"><img src="assets/img/team-6.jpg" class="img-fluid circle" width="80" alt=""></div></a>
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
				<img src="assets/img/alert-bg.png" alt="SVG" width="300">
			</div>
			<div class="position-absolute bottom-0 start-0 me-10 z-0">
				<img src="assets/img/circle.png" alt="SVG" width="150">
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
    </div>

    <!-- All Jquery -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/rangeslider.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/counterup.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/shuffle.min.js"></script>
    <script src="assets/js/wow.js"></script>
    <script src="assets/js/lunar.js"></script>

    <script src="assets/js/custom.js"></script>
</body>

</html>
