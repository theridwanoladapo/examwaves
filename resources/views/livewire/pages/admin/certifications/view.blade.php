<?php

use App\Models\Test;

use function Livewire\Volt\{state};

$getTests = fn () => $this->tests = Test::where('certification_id', $this->certification->id)->get();

state(['certification', 'tests' => $getTests]);

$deleteTest = function (Test $test) {
    $test->delete();

    $this->getTests();
}

?>

<div>
    <div class="dash-wrapsw card py-0 px-lg-5 px-4 pb-4 border-0 rounded-4 mb-4">
        <div class="position-absolute start-0 end-0 top-0 bg-primary ht-120"></div>
        <div class="position-absolute end-0 top-0 mt-5 pt-3 me-4 z-1">
            <a href="{{ route('admin.certifications.edit', $this->certification->id) }}" class="btn btn-sm btn-whites fw-medium">Edit Certification</a>
        </div>
        <div class="dash-y44 position-relative mb-3">
            <div class="dash-user-thumb mt-5 pt-2">
                @if ($this->certification->image_path)
                <img src="{{ asset($this->certification->image_path) }}" class="img-fluid bg-white p-2 border border-3" width="100" alt="IMG">
                @else
                <img src="{{ asset('assets/img/icon.png') }}" class="img-fluid bg-white p-2 border border-3" width="100" alt="IMG">
                @endif
            </div>
            <div class="dash-y45 row align-items-center justify-content-between gy-3 mt-3">
                <h5 class="m-0">{{ $this->certification->title }} ({{ $this->certification->code }}) <i class="fa-solid fa-circle-check fs-sm text-success ms-2"></i></h5>
                <div class="lios-parts-starts col-sm-8">
                    <p class="text-muted mb-0">Description:</p>
                    <p class="m-0 text-dark fw-medium"> {{ $this->certification->description ? $this->certification->description : 'Nil' }} </p>
                </div>
                <div class="lios-parts-starts col-sm-4">
                    <p class="text-muted mb-0">Exam:</p>
                    <p class="m-0 text-dark fw-medium"> {{ $this->certification->exam->name }} </p>
                </div>
            </div>
        </div>
    </div>

    <div class="dash-wrapsw card border-0 rounded-4">
        <div class="card-header">
            <h6>Practice Tests</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Certification</th>
                            <th scope="col">Time Limit</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->tests as $k => $test)
                        <tr>
                            <th>{{ $k+1 }}</th>
                            <td>{{ $test->name }}</td>
                            <td>{{ $test->certification->title }}</td>
                            <td>{{ $test->time_limit }}</td>
                            <td>
                                <a href="{{ route('admin.tests.view', $test->id) }}" class="square--30 circle text-light bg-seegreen d-inline-flex">
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
