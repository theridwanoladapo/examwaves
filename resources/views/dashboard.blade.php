<x-app-layout>
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
                            <div class="position-relative px-lg-4 py-lg-5 rounded-4 bg-white">

                                <div class="user-prfl text-center mx-auto">
                                    <div class="position-relative mb-2">
                                        <img src="{{ asset('assets/img/team-1.jpg') }}" class="img-fluid circle" width="120" alt="img">
                                    </div>
                                    <div class="user-caps">
                                        <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                                        <p class="m-0 text-muted">{{ auth()->user()->email }}</p>
                                    </div>
                                </div>

                                <div class="user-prfl-nav mt-4">
                                    <ul class="no-ul-list">
                                        <li class="py-3"><a href="{{ route('dashboard') }}" class="fw-medium active text-primary"><i class="fa-solid fa-gauge-high me-2"></i>User Dashboard</a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9 col-lg-8">


                    <!-- Dashboard Info -->
                    <div class="dash-wrapsw card border-0 rounded-4 py-4 mb-4">
                        <div class="card-body px-4">
                            <div class="d-sm-flex align-items-center mb-4">
                                <h1 class="h2 text-dark mb-4 mb-sm-0 me-4">Welcome to Your Dashboard</h1>
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
</x-app-layout>
