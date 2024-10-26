<?php

use App\Mail\RequestExamMail;
use Illuminate\Support\Facades\Mail;

use function Livewire\Volt\{state, rules};

state(['name', 'email', 'message']);

rules([
    'name' => 'required|string',
    'email' => 'required|email',
    'message' => 'required|string',
]);

$submit = function () {
    $this->validate();

    // Send the email
    Mail::to('support@examwaves.com')->send(new RequestExamMail($this->name, $this->email, $this->message));

    session()->flash('status', 'Your request / comment has been sent successfully!');

    // clear the form fields
    $this->reset();
}

?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="submit" class="row g-4" id="request-form" role="form">
        <div class="messages"></div>
        <div class="col-sm-6">
            <div class="form-floating mb-1">
                <input wire:model="name" class="form-control" type="text" name="name" placeholder="Your name" required>
                <label class="form-label">Name</label>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-floating mb-1">
                <input wire:model="email" class="form-control" type="email" name="email" placeholder="Your Email" required>
                <label class="form-label">Email</label>
            </div>
        </div>
        <div class="col-12">
            <div class="form-floating mb-1">
                <textarea wire:model="message" class="form-control ht-150" name="messages" placeholder="Type your comment here..." required></textarea>
                <label class="form-label">Comment / Request</label>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary px-lg-4" type="submit">Send your Request</button>
        </div>
    </form>
</div>
