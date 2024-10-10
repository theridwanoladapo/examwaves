<x-app-layout>

    <div class="breadcrumb-wraps gray-simple py-3">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-12">
                    <nav style="--bs-breadcrumb-divider: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg'
                        width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z'
                        fill='%236c757d'/%3E%3C/svg%3E");" aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item font--medium"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item font--medium"><a
                                    href="{{ route('providers.view', $certification->exam->id) }}">{{ $certification->exam->name }}</a></li>
                            <li class="breadcrumb-item font--medium active text-primary" aria-current="page">
                                {{ $certification->title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <livewire:pages.frontend.exams.view :certification="$certification" />

    <section class="bg-light">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-8 col-lg-8 col-md-12">
                    @php
                        // dd($certification);
                    @endphp
                    <livewire:pages.frontend.exams.comments :certification="$certification" />

                </div>
            </div>
        </div>
    </section>

</x-app-layout>
