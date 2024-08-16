<x-admin-layout>
    <!-- Account Dashboard Start -->
    <section>
        <div class="container">

            <div class="row justify-content-between">

                <div class="col-xl-3 col-lg-4">
                    <div class="offcanvas-lg offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" id="Sidebaruser">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title">Filters</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="offcanvas" data-bs-target="#Sidebaruser"></button>
                        </div>
                        <div class="offcanvas-body pt-0 pe-lg-4">
                            <livewire:layout.admin-sidebar />
                        </div>
                    </div>
                </div>

                <div class="col-xl-9 col-lg-8">
                    <!-- Dashboard Info -->
                    <div class="dash-wrapsw card border-0 rounded-4 py-4 mb-4">
                        <div class="card-body px-4">
                            <div class="d-sm-flex align-items-center mb-4">
                                <h1 class="h4 text-dark mb-4 mb-sm-0 me-4"><i class="fa-regular fa-user text-primary me-2"></i> Exams</h1>
                                <div class="d-flex ms-auto">
                                    <a href="{{ route('admin.exams.create')}}" class="btn btn-md btn-light gray-simple me-3 me-sm-4" wire:navigate>
                                        <i class="fa-solid fa-plus me-2 ms-n1"></i> Add New
                                    </a>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($exams as $k => $exam)
                                        <tr>
                                            <th scope="row">{{ $k+1 }}</th>
                                            <td>{{ $exam->name }}</td>
                                            <td>{{ $exam->description }}</td>
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
                    <!-- End Dashboard -->
                </div>

            </div>

        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Account Dashboard End -->
</x-admin-layout>