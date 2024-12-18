<div>
    <div class="position-relative px-lg-4 py-lg-5 rounded-4 bg-white">

        <div class="user-prfl text-center mx-auto">
            <div class="position-relative mb-2">
                <img src="{{ asset('assets/img/user-img.png') }}" class="img-fluid circle" width="120" alt="img">
            </div>
            <div class="user-caps">
                <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                <p class="m-0 text-muted">{{ auth()->user()->email }}</p>
            </div>
        </div>

        <div class="user-prfl-nav mt-4">
            <ul class="no-ul-list">
                <li class="py-2">
                    <a href="{{ route('dashboard') }}" class="fw-medium @if(request()->routeIs('dashboard')) {{'text-primary'}} @endif">
                        <i class="fa-solid fa-gauge-high me-2"></i> Dashboard
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('profile') }}" class="fw-medium @if(request()->routeIs('profile')) {{'text-primary'}} @endif">
                        <i class="fa-solid fa-id-card me-2"></i> Profile
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('exams') }}" class="fw-medium @if(request()->routeIs('exams')) {{'text-primary'}} @endif">
                        <i class="fa-solid fa-pen-fancy me-2"></i> My Exams
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('settings') }}" class="fw-medium @if(request()->routeIs('settings')) {{'text-primary'}} @endif">
                        <i class="fa-solid fa-gear me-2"></i> Security
                    </a>
                </li>
            </ul>
        </div>

    </div>
</div>
