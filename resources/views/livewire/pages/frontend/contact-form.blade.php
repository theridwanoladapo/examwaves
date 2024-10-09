<?php

use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

use function Livewire\Volt\{state, rules};

state(['name', 'email', 'phone', 'subject', 'message']);

rules([
    'name' => 'required|string',
    'email' => 'required|email',
    'phone' => 'nullable|numeric',
    'subject' => 'required|string',
    'message' => 'required|string',
]);

$submit = function () {
    $this->validate();
        // Process the email or save data to the database
        Mail::to('support@examwaves.com')->send(new ContactFormMail($this->name, $this->email, $this->phone, $this->subject, $this->message));

        session()->flash('status', 'Your message has been sent successfully!');

        // Optionally, clear the form fields
        $this->reset();
}

?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="submit" class="row g-4" id="contact-form" role="form">
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
        <div class="col-sm-6">
            <div class="form-floating mb-1">
                <input wire:model="phone" class="form-control" type="tel" name="tel" placeholder="Your Phone">
                <label class="form-label">Phone</label>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-floating mb-1">
                <input wire:model="subject" class="form-control" type="text" name="subject" placeholder="Subject" required>
                <label class="form-label">Subject</label>
            </div>
        </div>
        <div class="col-12">
            <div class="form-floating mb-1">
                <textarea wire:model="message" class="form-control ht-150" name="messages" placeholder="Type your comment here..." required></textarea>
                <label class="form-label">Comment</label>
            </div>
        </div>
        <div class="col-12">
            <div class="form-check mb-2">
                <input class="form-check-input" name="agree" value="Agree Terms & Conditions" type="checkbox">
                <label class="form-check-label">I agree to the <a class="nav-link d-inline fs-normal text-decoration-underline p-0" href="#">Terms &amp; Conditions</a></label>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary px-lg-4" type="submit">Send your Message</button>
        </div>
    </form>
</div>
