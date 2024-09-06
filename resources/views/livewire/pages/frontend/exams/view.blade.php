<?php

use function Livewire\Volt\{state, mount};

state(['certification']);

mount(function ($certification) {
    $this->certification = $certification;
});

$addToCart = function (int $certificationId) {
    
};

?>

<div>
    <section>
        <div class="container">

            <div class="row justify-content-between">
                <div class="col-xl-8 col-lg-8 col-md-12">

                    <!-- Exam Title -->
                    <h2 class="pb-2 pb-lg-3">{{ $this->certification->title }} ({{ $this->certification->code }})</h2>
                    <div class="d-flex flex-wrap align-items-center justify-content-between border-bottom mb-4">
                        <div class="d-flex align-items-center mb-4 me-4">
                            <span class="fs-sm me-2">Exam Provider:</span>
                            <a class="text-primary position-relative fw-semibold p-0" href="#" data-scroll=""
                                data-scroll-offset="80">
                                {{ $this->certification->exam->name }}
                                <span class="d-block position-absolute start-0 bottom-0 w-100"
                                    style="background-color: currentColor; height: 1px;"></span>
                            </a>
                        </div>
                        {{-- <div class="d-flex align-items-center mb-4"><span class="fs-sm me-2">Share post:</span>
                            <div class="d-flex">
                                <a class="text-muted p-2 me-2" href="#" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Instagram" data-bs-original-title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                                <a class="text-muted p-2 me-2" href="#" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Facebook" data-bs-original-title="Facebook"><i class="fa-brands fa-facebook"></i></a>
                                <a class="text-muted p-2 me-2" href="#" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Dribbble" data-bs-original-title="Dribbble"><i class="fa-brands fa-dribbble"></i></a>
                                <a class="text-muted p-2" href="#" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Twitter" data-bs-original-title="Twitter"><i class="fa-brands fa-twitter"></i></a>
                            </div>
                        </div> --}}
                    </div>

                    <!-- Exam Content -->
                    <h4 class="font--bold">Included in the Exam</h4>
                    <p>{{ exam_question_count($this->certification->id) }} questions</p>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Practice Tests
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <table class="table">
                                        <tbody>
                                            @foreach ($this->certification->tests as $k => $test)
                                            <tr>
                                                <th scope="row">{{ $test->name }} ({{ $this->certification->code }})</th>
                                                <td>{{ test_question_count($test->id) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Post Author -->
                    {{-- <div class="card border-0 w-100 d-inline-block bg-primary px-xl-5 px-lg-4 py-xl-5 py-lg-4 p-4 mt-4 mt-lg-5">
                        <div class="position-relative">
                            <div class="d-flex align-items-center justify-content-center pb-1 mb-3">
                                <span class="avatar bg-success text-white w-15 h-15 me-4"><span class="fs-30">DC</span></span>
                            </div>
                            <div class="caption-author text-center mb-4">
                                <h4 class="mb-0 text-light">Daniel Clarcues</h4>
                                <p class="p-0 m-0 text-sm-muted text-light opacity-75 font--medium">Web Designer, Canada</p>
                            </div>
                            <div class="about-author text-center mb-4">
                                <p class="fs-6 text-light">Pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances.</p>
                            </div>
                            <div class="social-author text-center">
                                <ul class="no-ul-list d-flex align-items-center justify-content-center">
                                    <li class="px-2"><a href="JavaScript:Void(0);" class="text-light"><i class="fa-brands fa-facebook"></i></a></li>
                                    <li class="px-2"><a href="JavaScript:Void(0);" class="text-light"><i class="fa-brands fa-twitter"></i></a></li>
                                    <li class="px-2"><a href="JavaScript:Void(0);" class="text-light"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li class="px-2"><a href="JavaScript:Void(0);" class="text-light"><i class="fa-brands fa-linkedin"></i></a></li>
                                    <li class="px-2"><a href="JavaScript:Void(0);" class="text-light"><i class="fa-brands fa-google-plus-g"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="detail-side-block border overflow-hidden rounded-3 mt-md-0 mt-4">
                        <div class="detail-side-head d-flex align-items-center gray-simple p-3">
                            <div class="side-flex-thumb">
                                <img src="assets/img/l-12.png" class="img-fluid" width="55" alt="">
                            </div>
                            <div class="side-flex-caption ps-3">
                                <div class="jbs-title-iop"><h4 class="m-0">${{ $this->certification->price }}</h4></div>
                                {{-- <div class="jbs-locat-oiu text-sm-muted">
                                    <span><i class="fa-solid fa-location-dot me-1"></i>California, USA</span>
                                </div> --}}
                            </div>
                        </div>
                        <div class="detail-side-middle py-3 px-3">
                            <div class="form-group">
                                <button wire:click="addToCart({{$this->certification->id}})" type="button" class="btn btn-primary full-width font-sm">Add to cart</button>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-outline-primary full-width font-sm">Buy Now</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <div class="clearfix"></div>
</div>
