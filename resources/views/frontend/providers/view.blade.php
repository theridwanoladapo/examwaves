<x-app-layout>

    <section class="bg-cover gray-simple pb-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-12">
                    <div class="breadcrumb-wrap">
                        <nav style="--bs-breadcrumb-divider: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg'
                        width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z'
                        fill='%236c757d'/%3E%3C/svg%3E");" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $exam->name }}</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row justify-content-start">
						<div class="col-lg-2 col-md-3 mb-4">
                            <div class="p-1 bg-white w-40 w-min-40 h-40 me-2 d-flex align-items-center">
                                @if (is_null($exam->image_path))
                                <img src="{{ asset('assets/img/ico.png') }}" class="w-100" />
                                @else
                                <img src="{{ asset($exam->image_path) }}" class="w-100" />
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div>
                                <h1 class="mb-0">{{ $exam->name }}</h1>
                                <p class="">{!! $exam->description !!}</p>
                                {{-- <div class="d-flex align-items-center">
                                    <div class="d-inline-flex align-items-center me-3"><span class="text-muted"><i class="fa-solid fa-location-dot opacity-75 me-1"></i>California, USA</span></div>
                                    <div class="d-inline-flex align-items-center me-3"><span class="text-muted"><i class="fa-solid fa-briefcase opacity-75 me-1"></i>IT & Software</span></div>
                                    <div class="d-inline-flex align-items-center jbs-kioyer-groups text-sm me-2">
                                        <span class="fa-solid fa-star text-warning me-1"></span>
                                        <span class="fa-solid fa-star text-warning me-1"></span>
                                        <span class="fa-solid fa-star text-warning me-1"></span>
                                        <span class="fa-solid fa-star text-warning me-1"></span>
                                        <span class="fa-solid fa-star me-2"></span>
                                        <span class="aal-reveis fw-bold">4.6</span>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">

            <div class="row align-items-center justify-content-center">
                <div class="col-xl-7 col-lg-7 col-md-11 mb-3">
                    <div class="sec-heading text-center">
                        <div class="d-inline-flex px-4 py-1 rounded-5 text-primary bg-light-primary font--medium mb-2"><span>Exams</span></div>
                        <h2 class="mb-1">Exams to get you started</h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center g-lg-4 g-3">
                @foreach ($exam->certifications as $certification)
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <div class="card border rounded-4 p-4 h-100 d-flex flex-column">
                        <div class="position-relative mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="dlio-catds">
                                    <h6 class="fw-medium mb-0 text-success bg-light-success rounded px-3 py-1 me-2">
                                        <a href="{{ route('providers.view', $certification->exam->id) }}">{{ $certification->exam->name }}</a>
                                    </h6>
                                </div>
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

        </div>
    </section>

</x-app-layout>
