<?php

use App\Models\Certification;

use function Livewire\Volt\{state, with, usesPagination, computed};

state(['searchQuery', 'perPage' => 10]);
state(['search'])->url();

$exams = computed(function () {
    $query = Certification::query();

    if ($search = $this->search) {
        $query->where('title', 'like', "%{$search}%")
                ->orWhere('code', 'like', "%{$search}%");
    }

    return $query;
});

usesPagination(theme: 'bootstrap');

with(fn () => ['certifications' => $this->exams->paginate($this->perPage)]);

// $getSearch = function () {
//     if (!empty($this->searchQuery)) {
//         return Certification::where('title', 'like', '%'.$this->searchQuery,'%')->paginate($this->perPage);
//     }

//     return Certification::paginate($this->perPage);
// };

?>

<div>
    <section class="bg-primary mb-3 py-4">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-10 col-md-12 col-sm-12">

                <div class="text-center">
                    <div class="">
                        <h5 class="text-light">Search for exams</h5>
                    </div>
                    <div class="">
                        <div class="newsltr-form rounded-3">
                            <input type="text" wire:model.live="search" class="form-control" placeholder="Search for your certification exams...">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @if (count($certifications) > 0)
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
                                {{ $certification->title }}
                                {{ $certification->code ? '('.$certification->code.')' : null }}
                            </a>
                        </h5>
                    </div>
                </div>
                <div class="mt-auto">
                    <div class="crd-srv gray-simple d-flex align-items-center justify-content-between px-3 py-3 rounded-3 mt-3">
                        <div class="empl-thumb">
                            <h6><span class="fw-semibold mb-0">Practice Exam:</span> {{ exam_test_count($certification->id) }}</h6>
                            <h6><span class="fw-semibold mb-0">Question Exam:</span> {{ exam_question_count($certification->id) }}</h6>
                        </div>
                        <a href="{{ route('certifications.view', $certification->id) }}" class="btn btn-md btn-primary">See more</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="row align-items-center justify-content-center mt-5">
        <div class="col-xl-7 col-lg-7 col-md-11 mb-3 text-center wow animated fadeInUp">
            <h5>No results found..</h5>
        </div>
    </div>
    @endif

    {{ $certifications->links('components.pagination-links') }}
</div>
