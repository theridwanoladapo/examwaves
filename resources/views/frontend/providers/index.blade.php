<x-app-layout>
    <section class="bg-light">
        <div class="container">

            <div class="row align-items-center justify-content-center">
                <div class="col-xl-7 col-lg-7 col-md-11 mb-3">
                    <div class="sec-heading text-center">
                        <div class="d-inline-flex px-4 py-1 rounded-5 text-primary bg-light-primary font--medium mb-2"><span>Exam Providers</span></div>
                        <h2 class="mb-1">All Exam Providers</h2>
                    </div>
                </div>
            </div>

            <div class="row g-xl-4 g-lg-3 g-3">
                @foreach ($exams as $exam)
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
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
        </div>
    </section>

</x-app-layout>
