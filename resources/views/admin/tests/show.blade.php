<x-admin-layout>
    <!-- Account Dashboard Start -->
    <section>
        <div class="container">

            <div class="row justify-content-between">

                <div class="col-xl-3 col-lg-4">
                    <div class="offcanvas-lg offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" id="Sidebaruser">
                        <div class="offcanvas-header">
                            {{-- <h5 class="offcanvas-title">Filters</h5> --}}
                            <button class="btn-close" type="button" data-bs-dismiss="offcanvas" data-bs-target="#Sidebaruser"></button>
                        </div>
                        <div class="offcanvas-body pt-0 pe-lg-4">
                            <livewire:layout.admin-sidebar />
                        </div>
                    </div>
                </div>

                <div class="col-xl-9 col-lg-8">

                    <div class="dash-wrapsw card py-0 px-lg-5 px-4 pb-4 border-0 rounded-4 mb-4">
                        <div class="position-absolute start-0 end-0 top-0 bg-primary ht-120"></div>
                        <div class="position-absolute end-0 top-0 mt-5 pt-3 me-4 z-1">
                            {{-- <a href="{{ route('admin.tests.edit', $test->id) }}" class="btn btn-sm btn-whites fw-medium">Edit Test</a> --}}
                            {{-- <a href="{{ route('admin.questions.add', $test->id) }}" class="btn btn-sm btn-whites fw-medium">Add Question</a> --}}
                        </div>
                        <div class="dash-y44 position-relative mb-3">
                            <div class="dash-user-thumb mt-5 pt-2">
                                @if ($test->image_path)
                                <img src="{{ asset($test->image_path) }}" class="img-fluid bg-white p-2 border border-3" width="100" alt="IMG">
                                @else
                                <img src="{{ asset('assets/img/icon.png') }}" class="img-fluid bg-white p-2 border border-3" width="100" alt="IMG">
                                @endif
                            </div>
                            <div class="dash-y45 row align-items-center justify-content-between gy-3 mt-3">
                                <h5 class="m-0">{{ $test->name }} <i class="fa-solid fa-circle-check fs-sm text-success ms-2"></i></h5>
                                <div class="lios-parts-starts col-sm-6">
                                    <p class="text-muted mb-0">Certification:</p>
									<p class="m-0 text-dark fw-medium"> {{ $test->certification->title }} </p>
                                </div>
                                <div class="lios-parts-starts col-sm-6">
                                    <p class="text-muted mb-0">Exam Provider:</p>
									<p class="m-0 text-dark fw-medium"> {{ $test->certification->exam->name }} </p>
                                </div>
                                <div class="lios-parts-starts col-sm-6">
                                    <p class="text-muted mb-0">Time Limit:</p>
									<p class="m-0 text-dark fw-medium"> {{ $test->time_limit }} mins</p>
                                </div>
                                <div class="lios-parts-starts col-sm-6">
                                    <p class="text-muted mb-0">Pass Percentage:</p>
									<p class="m-0 text-dark fw-medium"> {{ $test->pass_percent }}%</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.tests.quiz', $test->id) }}" class="mt-3 btn btn-sm btn-primary fw-medium">Try Test</a>
                        </div>
                    </div>

                    <div class="dash-wrapsw card border-0 rounded-4">
                        <div class="card-header">
                            <h6>Questions</h6>
                        </div>
                        <div class="card-body">
                            
                            <livewire:pages.admin.questions.list :test_id="$test->id" />

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>

</x-admin-layout>
