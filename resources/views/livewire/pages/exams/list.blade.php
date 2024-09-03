<?php

use App\Models\Certification;

use function Livewire\Volt\{with, usesPagination};

usesPagination(theme: 'bootstrap');

with(fn () => ['certifications' => Certification::paginate(10)]);

?>

<div>
    <div class="row justify-content-center g-lg-4 g-3">
        @foreach ($certifications as $certification)
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <div class="card border rounded-4 p-4 h-100 d-flex flex-column">
                <div class="position-relative mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="dlio-catds">
                            <h6 class="fw-medium mb-0 text-success bg-light-success rounded px-3 py-1 me-2">
                                <a href="javascript:void(0)">{{ $certification->exam->name }}</a>
                            </h6>
                        </div>
                    </div>
                    <div class="d-flex">
                        <h5 class="lh-base fw-semibold mb-0">
                            <a href="javascript:void(0)" class="jbl-detail">
                                {{ $certification->title }} ({{ $certification->code }})
                            </a>
                        </h5>
                    </div>
                </div>
                <div class="mt-auto">
                    <span class="fw-medium"><i class="fas fa-star text-warning mx-2"></i> Rating: {{ $certification->rating }}</span>
                    <div class="crd-srv gray-simple d-flex align-items-center justify-content-between px-3 py-3 rounded-3 mt-3">
                        <div class="empl-thumb">
                            <h6 class="fw-semibold mb-0">${{ $certification->price }}</h6>
                        </div>
                        <a href="javascript:void(0)" class="btn btn-md btn-primary">See more</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{ $certifications->links('components.pagination-links') }}
</div>
