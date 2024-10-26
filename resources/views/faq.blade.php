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

        <!-- ============================ FAQs ================================== -->
        <section class="position-relative">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-10 col-md-12 col-sm-12">

                        <div class="exlopi-yut">
                            <div class="text-center mb-5">
                                <h1 class="display-5 font--bold">Frequently Asked Questions <span class="text-primary">(FAQs)</span></h1>
                                <p class="text-muted fs-6">Got a question about examwaves? We're here to help you.</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row justify-content-between align-items-start g-4">

                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-xl-0 mb-lg-0 mb-3">
                        <div class="accordion" id="PanelsStayOpen">
                            <div class="accordion-item mb-3 border rounded-3 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                                        What is ExamWaves?
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        ExamWaves is an affordable and user-friendly exam practice platform designed to help you prepare for your certification exams with accurate, expert-verified practice questions. Our goal is to provide high-quality exam prep without the high costs associated with traditional providers.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mb-3 border rounded-3 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                        How do I access the exam practice questions?
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        Once you’ve purchased or signed up for a practice exam, you can instantly access the questions and answers directly from our platform. All of our materials are easily accessible and ready for use right away.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mb-3 border rounded-3 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                        Are your exam questions up to date?
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        Yes! We work closely with industry experts to ensure that our practice questions are regularly updated to reflect the latest exam formats and content. This guarantees you are studying with the most relevant and accurate information.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mb-3 border rounded-3 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                        Do I need a special test engine like VCE to use your practice exams?
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        No, you don’t need any complicated or expensive test engines like VCE. Our exams are provided in a straightforward format that can be accessed easily without any additional software or tools.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border rounded-3 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                        What types of exams do you cover?
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        We cover a wide range of certification exams, including IT certifications (such as AWS, Cisco, Microsoft, CompTIA) and professional qualifications in various industries. Our exam library is constantly expanding to meet the needs of our users.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="accordion" id="PanelsStayOpens">
                            <div class="accordion-item mb-3 border rounded-3 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#PanelsStayOpens-collapseOne1" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne1">
                                        How often are new questions added?
                                    </button>
                                </h2>
                                <div id="PanelsStayOpens-collapseOne1" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        We continuously update our database of questions based on feedback from users and changes in exam formats. This ensures you are always practicing with the latest and most relevant questions.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mb-3 border rounded-3 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#PanelsStayOpens-collapseTwo1" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo1">
                                        Is there a pass guarantee?
                                    </button>
                                </h2>
                                <div id="PanelsStayOpens-collapseTwo1" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        While no platform can guarantee 100% success, we are proud of our 99.6% pass rate. With the right dedication and use of our practice materials, you significantly increase your chances of passing your exam on the first attempt.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mb-3 border rounded-3 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#PanelsStayOpens-collapseThree1" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree1">
                                        Can I get a refund if I’m not satisfied?
                                    </button>
                                </h2>
                                <div id="PanelsStayOpens-collapseThree1" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        Yes, we offer a satisfaction guarantee. If you are not satisfied with your purchase or feel the materials did not meet your expectations, please contact our support team within 7 days of purchase for a refund or resolution.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border rounded-3 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#PanelsStayOpens-collapseFour1" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour1">
                                        How do I contact customer support?
                                    </button>
                                </h2>
                                <div id="PanelsStayOpens-collapseFour1" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        If you have any questions or need assistance, our support team is ready to help. You can reach us through our contact form on the website, or email us directly at support@examwaves.com.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <div class="clearfix"></div>
        <!-- ============================ General FAQ End ================================== -->

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
