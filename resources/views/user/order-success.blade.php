<x-app-layout>
    <!-- Checkout Start -->
    <section>
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-12">
                    @if(session()->has('success'))
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="card border-0 rounded-4 p-4">
                                    <div class="row">

                                        <div class="col-xl-12">
                                            <div class="p-4 bg-success rounded-3 h-100 text-center">
                                                <span class="text-white display-1"><i class="fa fa-check-circle"></i></span>
                                                <h2 class="h4 text-light fw-bold my-2">Confirmed</h2>
                                                <p class="text-light">{{ session()->get('success') }}</p>
                                                <a href="{{ route('exams') }}" class="btn btn-light btn-sm mt-3">Go to exams</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Checkout End -->
</x-app-layout>
