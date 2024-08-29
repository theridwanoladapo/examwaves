<?php

use function Livewire\Volt\{state};

//

?>

<div>
    <div class="dash-wrapsw card py-0 px-lg-5 px-4 pb-4 border-0 rounded-4 mb-4">
        <div class="position-absolute start-0 end-0 top-0 bg-primary ht-120"></div>
        <div class="position-absolute end-0 top-0 mt-5 pt-3 me-4 z-1">
            <a href="{{ route('profile') }}" class="btn btn-sm btn-whites fw-medium">Edit Profile</a>
        </div>
        <div class="dash-y44 position-relative mb-3">
            <div class="dash-user-thumb mt-5 pt-2">
                <img src="{{ asset('assets/img/favicon.png') }}" class="img-fluid circle border border-3" width="100" alt="User">
            </div>
            <div class="dash-y45 row align-items-center justify-content-between gy-3">
                <div class="lios-parts-starts col-sm-7">
                    <h5 class="m-0">{{ auth()->user()->name }} <i class="fa-solid fa-circle-check fs-sm text-success ms-2"></i></h5>
                    <p class="m-0 text-muted">{{ auth()->user()->email }}</p>
                </div>
                {{-- <div class="lios-parts col-sm-4">
                    <h6>Profile Completion 65%</h6>
                    <div class="progress" role="progressbar" aria-label="Default striped example" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar progress-bar-striped bg-success" style="width: 65%"></div>
                    </div>
                </div> --}}
            </div>
        </div>

        <!--  -->
        {{-- <div class="dash-y45">
            <ul class="no-ul-list row g-4">
                <li class="col-sm-5">
                    <p class="text-muted mb-0">Phone</p>
                    <p class="m-0 text-dark fw-medium">+91 256 658 7458</p>
                </li>
                <li class="col-sm-5">
                    <p class="text-muted mb-0">Email</p>
                    <p class="m-0 text-dark fw-medium">Themezhub@gmail.com</p>
                </li>
                <li class="col-sm-5">
                    <p class="text-muted mb-0">Gender</p>
                    <p class="m-0 text-dark fw-medium">Male</p>
                </li>
                <li class="col-sm-5">
                    <p class="text-muted mb-0">Birth</p>
                    <p class="m-0 text-dark fw-medium">17 July 1992</p>
                </li>
                <li class="col-sm-5">
                    <p class="text-muted mb-0">City</p>
                    <p class="m-0 text-dark fw-medium">Allahabad</p>
                </li>
                <li class="col-sm-5">
                    <p class="text-muted mb-0">Country</p>
                    <p class="m-0 text-dark fw-medium">India</p>
                </li>
                <li class="col-sm-5">
                    <p class="text-muted mb-0">Zip</p>
                    <p class="m-0 text-dark fw-medium">2304030</p>
                </li>
                <li class="col-sm-5">
                    <p class="text-muted mb-0">Language</p>
                    <p class="m-0 text-dark fw-medium">English</p>
                </li>
            </ul>
        </div> --}}

    </div>

    <div class="dash-wrapsw card border-0 rounded-4">
        <div class="card-header">
            <h6>My Exams</h6>
        </div>
        <div class="card-body">
            <p class="text-center">You have no exams</p>
            {{-- <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Sr. No.</th>
                            <th scope="col">Invoices</th>
                            <th scope="col">Create Date</th>
                            <th scope="col">Ammount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>01</th>
                            <td>#124673</td>
                            <td>15 Mar 2023</td>
                            <td><strong>$60</strong></td>
                            <td><span class="label text-success bg-light-success">Completed</span></td>
                            <td><a href="#" class="square--30 circle text-light bg-seegreen d-inline-flex"><i class="fa-solid fa-eye"></i></a><a href="#" class="square--30 circle text-light bg-danger d-inline-flex ms-2"><i class="fa-solid fa-trash"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div> --}}
        </div>
    </div>
</div>