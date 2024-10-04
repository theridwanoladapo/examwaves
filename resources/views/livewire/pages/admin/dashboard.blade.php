<?php

use App\Models\User;
use App\Models\Exam;
use App\Models\Certification;
use App\Models\Test;
use App\Models\Question;

use function Livewire\Volt\{state};

$countUser = fn () => $this->countUser = User::where('role', 0)->count();
$countExam = fn () => $this->countExam = Exam::count();
$countCertification = fn () => $this->countCertification = Certification::count();
$countTest = fn () => $this->countTest = Test::count();
$countQuestion = fn () => $this->countQuestion = Question::count();

state([
    'countUser' => $countUser,
    'countExam' => $countExam,
    'countCertification' => $countCertification,
    'countTest' => $countTest,
    'countQuestion' => $countQuestion,
]);

?>

<div>
    <div class="row row-cols-1 row-cols-md-2 g-4">

        <div class="col">
            <div class="card h-100 rounded-4 border p-3 p-sm-4">
                <div class="d-flex align-items-center pb-2 mb-1">
                    <div class="square--60 circle bg-light-warning text-warning">
                        <i class="fa-solid fa-id-card fs-2"></i>
                    </div>
                    <div class="ps-3">
                        <h5 class="fs-1 mb-1"><span class="ctr text-primary me-1">{{ $this->countUser }}</span></h5>
                        <p>Total Users</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 rounded-4 border p-3 p-sm-4">
                <div class="d-flex align-items-center pb-2 mb-1">
                    <div class="square--60 circle bg-light-success text-success">
                        <i class="fa-solid fa-pen-fancy fs-2"></i>
                    </div>
                    <div class="ps-3">
                        <h5 class="fs-1 mb-1"><span class="ctr text-primary me-1">{{ $this->countExam }}</span></h5>
                        <p>Total Exam Providers</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 rounded-4 border p-3 p-sm-4">
                <div class="d-flex align-items-center pb-2 mb-1">
                    <div class="square--60 circle bg-light-purple text-purple">
                        <i class="fa-solid fa-certificate fs-2"></i>
                    </div>
                    <div class="ps-3">
                        <h5 class="fs-1 mb-1"><span class="ctr text-primary me-1">{{ $this->countCertification }}</span></h5>
                        <p>Total Certifications</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 rounded-4 border p-3 p-sm-4">
                <div class="d-flex align-items-center pb-2 mb-1">
                    <div class="square--60 circle bg-light-danger text-danger">
                        <i class="fa-solid fa-file-pen fs-2"></i>
                    </div>
                    <div class="ps-3">
                        <h5 class="fs-1 mb-1"><span class="ctr text-primary me-1">{{ $this->countTest }}</span></h5>
                        <p>Total Tests</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
