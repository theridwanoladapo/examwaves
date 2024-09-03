<x-app-layout>

    <div class="breadcrumb-wraps gray-simple py-3">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-12">
                    <nav style="--bs-breadcrumb-divider: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E");" aria-label="breadcrumb">
                      <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item font--medium"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item font--medium"><a href="{{ route('certifications') }}">{{ $certification->exam->name }}</a></li>
                        <li class="breadcrumb-item font--medium active text-primary" aria-current="page">{{ $certification->title }}</li>
                      </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="container">

            <div class="row justify-content-between">
                <div class="col-xl-8 col-lg-8 col-md-12">

                    <!-- Exam Title -->
                    <h2 class="pb-2 pb-lg-3">{{ $certification->title }} ({{ $certification->code }})</h2>
                    <div class="d-flex flex-wrap align-items-center justify-content-between border-bottom mb-4">
                        <div class="d-flex align-items-center mb-4 me-4">
                            <span class="fs-sm me-2">Exam Provider:</span>
                            <a class="text-primary position-relative fw-semibold p-0" href="#" data-scroll="" data-scroll-offset="80">
                                {{ $certification->exam->name }} <span class="d-block position-absolute start-0 bottom-0 w-100" style="background-color: currentColor; height: 1px;"></span>
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
                    <p class="fs-6 pt-2 pt-sm-3">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
                    <p class="fs-6 pt-2 pt-sm-3">The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>

                    <h2 class="h4 pt-3 pt-md-4 pt-xl-5">Benifits with Working on killar App's</h2>
                    <p class="fs-6 pt-2 mb-4">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.<p>

                    <!-- Post Author -->
                    <div class="card border-0 w-100 d-inline-block bg-primary px-xl-5 px-lg-4 py-xl-5 py-lg-4 p-4 mt-4 mt-lg-5">
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
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-12 col-xl-offset-1">
                    <div class="blogs-sidewraps pt-lg-0 pt-4">

                        <div class="blogs-sides">
                            <!-- Search Box -->
                            <div class="position-relative mb-4 mb-lg-5"><i class="fa-solid fa-magnifying-glass position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                                <input class="form-control ps-5" type="search" placeholder="Enter keyword">
                            </div>

                            <!-- category -->
                            <h4 class="font--bold">Categories:</h4>
                            <ul class="no-ul-list mb-4 mb-lg-5">
                                <li>
                                    <div class="d-flex align-items-center justify-content-between py-1">
                                        <div class="escols">
                                            <input id="b1" class="form-check-input" name="b1" type="checkbox">
                                            <label for="b1" class="form-check-label">All categories</label>
                                        </div>
                                        <span class="fs-xs text-muted me-1">142</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center justify-content-between py-1">
                                        <div class="escols">
                                            <input id="b2" class="form-check-input" name="b2" type="checkbox">
                                            <label for="b2" class="form-check-label">Branding</label>
                                        </div>
                                        <span class="fs-xs text-muted ms-auto">16</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center justify-content-between py-1">
                                        <div class="escols">
                                            <input id="b3" class="form-check-input" name="b3" type="checkbox">
                                            <label for="b3" class="form-check-label">Software</label>
                                        </div>
                                        <span class="fs-xs text-muted ms-auto">22</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center justify-content-between py-1">
                                        <div class="escols">
                                            <input id="b4" class="form-check-input" name="b4" type="checkbox">
                                            <label for="b4" class="form-check-label">Advertisement</label>
                                        </div>
                                        <span class="fs-xs text-muted ms-auto">52</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center justify-content-between py-1">
                                        <div class="escols">
                                            <input id="b5" class="form-check-input" name="b5" type="checkbox">
                                            <label for="b5" class="form-check-label">E-commerce</label>
                                        </div>
                                        <span class="fs-xs text-muted ms-auto">62</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center justify-content-between py-1">
                                        <div class="escols">
                                            <input id="bg5" class="form-check-input" name="bg5" type="checkbox">
                                            <label for="bg5" class="form-check-label">Travel & Guide</label>
                                        </div>
                                        <span class="fs-xs text-muted ms-auto">54</span>
                                    </div>
                                </li>
                            </ul>

                            <!-- Trending -->
                            <h4 class="font--bold">Trending Post:</h4>
                            <div class="position-relative mt-4 mb-4 mb-lg-5">
                                <article class="position-relative d-flex align-items-center mb-4">
                                    <img class="rounded" src="assets/img/blog-1.jpg" width="90" alt="Post Thumb">
                                    <div class="ps-3">
                                        <h4 class="h6 mb-2">
                                            <a class="stretched-link" href="blog-single-v1.html">How work with killar software?</a>
                                        </h4>
                                        <span class="text-sm-muted">10 min ago</span>
                                    </div>
                                </article>
                                <article class="position-relative d-flex align-items-center mb-4">
                                    <img class="rounded" src="assets/img/blog-2.jpg" width="90" alt="Post Thumb">
                                    <div class="ps-3">
                                        <h4 class="h6 mb-2">
                                            <a class="stretched-link" href="blog-single-v1.html">Can we increase our revinue with killar</a>
                                        </h4>
                                        <span class="text-sm-muted">02 hours ago</span>
                                    </div>
                                </article>
                                <article class="position-relative d-flex align-items-center mb-4">
                                    <img class="rounded" src="assets/img/blog-3.jpg" width="90" alt="Post Thumb">
                                    <div class="ps-3">
                                        <h4 class="h6 mb-2">
                                            <a class="stretched-link" href="blog-single-v1.html">Facebook trends that will definitely work</a>
                                        </h4>
                                        <span class="text-sm-muted">2 days ago</span>
                                    </div>
                                </article>

                            </div>


                            <!-- Tags -->
                            <h4 class="font--bold">Popular Tags:</h4>
                            <div class="position-relative tags-rap d-inline-block mb-4 mb-lg-5 mt-2">
                                <a href="#" class="gray-simple px-2 py-1 d-inline-block rounded me-2 mb-2">Shop</a>
                                <a href="#" class="gray-simple px-2 py-1 d-inline-block rounded me-2 mb-2">Trends</a>
                                <a href="#" class="gray-simple px-2 py-1 d-inline-block rounded me-2 mb-2">Shoes</a>
                                <a href="#" class="gray-simple px-2 py-1 d-inline-block rounded me-2 mb-2">Social</a>
                                <a href="#" class="gray-simple px-2 py-1 d-inline-block rounded me-2 mb-2">Travel</a>
                                <a href="#" class="gray-simple px-2 py-1 d-inline-block rounded me-2 mb-2">Guide</a>
                                <a href="#" class="gray-simple px-2 py-1 d-inline-block rounded me-2 mb-2">IPL</a>
                                <a href="#" class="gray-simple px-2 py-1 d-inline-block rounded me-2 mb-2">Real Estate</a>
                            </div>

                            <!-- category -->
                            <h4 class="font--bold">Follow Us On:</h4>
                            <div class="position-relative d-inline-flex">
                                <a class="square--40 btn--instagram rounded-circle mt-2" href="#"><i class="fa-brands fa-instagram"></i></a>
                                <a class="square--40 btn--facebook rounded-circle mt-2 ms-3" href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                <a class="square--40 btn--twitter rounded-circle mt-2 ms-3" href="#"><i class="fa-brands fa-twitter"></i></a>
                                <a class="square--40 btn--dribbble rounded-circle mt-2 ms-3" href="#"><i class="fa-brands fa-dribbble"></i></a>
                            </div>
                        </div>

                        <div class="blogs-sides mt-4 mt-lg-5">
                            <img src="assets/img/popeyes-banner-ad.jpg" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <div class="clearfix"></div>

</x-app-layout>
