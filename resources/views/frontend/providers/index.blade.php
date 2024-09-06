<x-app-layout>
{{--
    <div class="breadcrumb-wraps gray-simple py-3">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-12">
                    <nav style="--bs-breadcrumb-divider: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg'
                        width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z'
                        fill='%236c757d'/%3E%3C/svg%3E");" aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item font--medium"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item font--medium active text-primary" aria-current="page">Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div> --}}

    <section class="bg-cover gray-simple">
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
                                <img src="{{ asset($exam->image_path) }}" class="w-100" />
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div>
                                <h1 class="mb-0">{{ $exam->name }}</h1>
                                <p class="">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus commodi maxime,
                                    magni reprehenderit quia perferendis mollitia impedit veritatis necessitatibus,
                                    praesentium voluptatem tempore hic dolores quod deserunt. Ipsa tempora excepturi perferendis.</p>
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

</x-app-layout>
