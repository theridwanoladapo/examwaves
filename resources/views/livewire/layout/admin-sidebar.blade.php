<div>
    <div class="position-relative px-lg-4 py-lg-5 rounded-4 bg-white">

        <div class="user-prfl text-center mx-auto">
            <div class="position-relative mb-2">
                <img src="{{ asset('assets/img/ico.png') }}" class="img-fluid circle" width="120" alt="img">
            </div>
            <div class="user-caps">
                <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                <p class="m-0 text-muted">{{ auth()->user()->email }}</p>
            </div>
        </div>

        <div class="user-prfl-nav mt-4">
            <ul class="no-ul-list">
                <li class="py-2">
                    <a href="{{ route('admin.dashboard') }}" class="fw-medium @if(request()->routeIs('admin.dashboard')) {{'text-primary'}} @endif" wire:navigate>
                        <i class="fa-solid fa-gauge-high me-2"></i> Dashboard
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('admin.exams.index') }}" class="fw-medium @if(request()->routeIs('admin.exams*')) {{'text-primary'}} @endif" wire:navigate>
                        <i class="fa-solid fa-pen-fancy me-2"></i> Exam Providers
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('admin.certifications.index') }}" class="fw-medium @if(request()->routeIs('admin.certifications*')) {{'text-primary'}} @endif" wire:navigate>
                        <i class="fa-solid fa-certificate me-2"></i> Certifications
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('admin.tests.index') }}" class="fw-medium @if(request()->routeIs('admin.tests*')) {{'text-primary'}} @endif" wire:navigate>
                        <i class="fa-solid fa-file-pen me-2"></i> Tests
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('admin.questions.create') }}" class="fw-medium @if(request()->routeIs('admin.questions.create')) {{'text-primary'}} @endif" wire:navigate>
                        <i class="fa-solid fa-plus me-2"></i> Add Question
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('admin.questions.upload') }}" class="fw-medium @if(request()->routeIs('admin.questions.upload')) {{'text-primary'}} @endif" wire:navigate>
                        <i class="fa-solid fa-upload me-2"></i> Upload Questions
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('admin.users.index') }}" class="fw-medium @if(request()->routeIs('admin.users.index')) {{'text-primary'}} @endif" wire:navigate>
                        <i class="fa-solid fa-user me-2"></i> Users
                    </a>
                </li>
            </ul>
        </div>

    </div>
</div>
