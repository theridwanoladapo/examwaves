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
                    <!-- Dashboard Info -->
                    <livewire:pages.admin.exams.create />
                    <!-- End Dashboard -->
                </div>

            </div>

        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Account Dashboard End -->
</x-admin-layout>