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
                            <a href="{{ route('admin.exams.edit', $exam->id) }}" class="btn btn-sm btn-whites fw-medium">Edit Exam</a>
                        </div>
                        <div class="dash-y44 position-relative mb-3">
                            <div class="dash-user-thumb mt-5 pt-2">
                                @if ($exam->image_path)
                                <img src="{{ asset($exam->image_path) }}" class="img-fluid bg-white p-2 border border-3" width="100" alt="IMG">
                                @else
                                <img src="{{ asset('assets/img/icon.png') }}" class="img-fluid bg-white p-2 border border-3" width="100" alt="IMG">
                                @endif
                            </div>
                            <div class="dash-y45 row align-items-center justify-content-between gy-3 mt-3">
                                <div class="lios-parts-starts col-sm-7">
                                    <h5 class="m-0">{{ $exam->name }} <i class="fa-solid fa-circle-check fs-sm text-success ms-2"></i></h5>
                                    <p class="text-muted mb-0">Description:</p>
									<p class="m-0 text-dark fw-medium"> {{ $exam->description ? $exam->description : 'Nil' }} </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dash-wrapsw card border-0 rounded-4">
                        <div class="card-header">
                            <h6>Certifications List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Code</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Rating</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($exam->certifications as $k => $certification)
                                        <tr>
                                            <th>{{ $k+1 }}</th>
                                            <td>{{ $certification->title }}</td>
                                            <td>{{ $certification->code }}</td>
                                            <td><strong>${{ $certification->price }}</strong></td>
                                            <td><span class="badge text-bg-info circle">{{ $certification->rating }}</span></td>
                                            <td>
                                                <a href="javascript:void(0)" class="square--30 circle text-light bg-seegreen d-inline-flex">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="square--30 circle text-light bg-danger d-inline-flex ms-2">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>

</x-admin-layout>
