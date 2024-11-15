<?php

use App\Repositories\OrderRepository;
use App\Models\User;
use App\Models\Certification;

use function Livewire\Volt\{state};

$getUser = fn () => $this->user = User::find($this->user_id);
$getCertifications = fn () => $this->certifications = Certification::all();

state(['user_id', 'user' => $getUser, 'certification_id', 'certifications' => $getCertifications]);

$assignExam = function () {
    $certification = Certification::find($this->certification_id);

    $data = [
        'user_id' => $this->user->id,
        'total' => $certification->price,
    ];

    $cartItems = [[
        'id' => $certification->id,
        'price' => $certification->price,
    ]];

    $orderRepository = new OrderRepository();
    $orderRepository->createOrder($data, $cartItems, 'success');

    session()->flash('success', 'Exam has been assigned to user successfully!');

    return $this->redirectRoute('admin.users.view', $this->user, navigate: true);
}

?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('success')" />

    <div class="dash-wrapsw card border-0 rounded-4 py-4 mb-4">
        <div class="card-headers border-0 py-4 px-4 pb-0 pt-1">
            <h4><i class="fa-solid fa-pen-fancy text-primary me-2"></i>Assign exam to user</h4>
        </div>

        <div class="card-body px-4">

            <form wire:submit.prevent="assignExam">

                <div class="row mt-0 mt-lg-2">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger fw-bold">*</span></label>
                        <input name="name" id="name" type="text" class="form-control" value="{{ $user->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="certification_id" class="form-label">Certification <span class="text-danger fw-bold">*</span></label>
                        <select wire:model="certification_id" name="certification_id" id="certification_id" class="form-select" placeholder="Certification">
                            <option>Select</option>
                            @foreach ($certifications as $certification)
                            <option value="{{ $certification->id }}">{{ $certification->title }}
                                {{ $certification->code ? '('.$certification->code.')' : null }}
                            </option>
                            @endforeach
                        </select>
                        @error('certification_id') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>

                </div>

                <div class="d-flex justify-content-start pt-3">
                    <button class="btn btn-md btn-primary me-2" type="submit">Assign</button>
                    <a href="{{ route('admin.users.view', $user->id) }}" class="btn btn-md btn-outline-dark me-3">Cancel</a>
                </div>

            </form>
        </div>
    </div>
</div>
