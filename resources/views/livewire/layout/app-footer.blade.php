<?php

use function Livewire\Volt\{state};

//

?>

<div>
    <footer class="footer skin-light-footer">
        <div>
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-4">
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

                    <div class="col-lg-4 col-md-4">
                        <div class="footer-widget">
                            <h4 class="widget-title">The Company</h4>
                            <ul class="footer-menu">
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li><a href="{{ route('contact') }}">Contact us</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <div class="footer-widget">
                            <h4 class="widget-title font--bold">For Clients</h4>
                            <ul class="footer-menu">
                                <li><a href="{{ route('request-exam') }}">Request Exam</a></li>
                                <li><a href="{{ route('faq') }}">FAQs</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center justify-content-between">

                    <div class="col-12 text-center">
                        Examwaves.com materials do not contain actual questions and answers from Microsoft or any other certification exams provider.</p>
                    </div>
                    <div class="col-12 text-center">
                        <p class="mb-0 justify-between">
                            <span>© 2024 Powered by ExamWaves</span>
                            {{-- <span class="ms-3">|</span>  --}}
                            {{-- <span class="ms-3">Developed by <a href="https://genuineict.com">Genuine ICT</a></span>. --}}
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </footer>
</div>
