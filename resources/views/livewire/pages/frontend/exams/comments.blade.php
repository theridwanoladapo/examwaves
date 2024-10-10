<?php

use App\Models\Comment;

use function Livewire\Volt\{state, rules, mount, on};

$getReviews = fn () => $this->reviews = Comment::where('certification_id', $this->certification->id)->latest()->get();

state([
    'certification',
    'user_id' => auth()->user()->id ?? null,
    'comment',
    'rating' => 5,
    'reviews' => $getReviews,
]);

rules([
    'comment' => 'required|string|min:25',
    'rating' => 'required|integer|min:1|max:5'
]);

on(['commentAdded' => function () {
    $this->reviews = Comment::where('certification_id', $this->certification->id)->latest()->get();
}]);

$submitComment = function () {
    $this->validate();

    // add comment to database
    Comment::create([
        'certification_id' => $this->certification->id,
        'user_id' => $this->user_id,
        'comment' => $this->comment,
        'rating' => $this->rating,
    ]);

    session()->flash('status', 'Your message has been sent successfully!');

    // clear the form fields
    $this->reset(['comment', 'rating']);

    $this->dispatch('commentAdded');
}

?>

<div>
    <div class="pt-4 mt-4" id="comments">
        <h2 class="h2 text-dark py-lg-1 py-xl-3">{{ count($reviews) }} review(s)</h2>

        @if ($reviews)
        <div class="card border-0 mb-4 pt-2 p-md-2 p-xl-3 p-xxl-4 mt-n3 mt-md-0 overflow-y-auto" style="max-height: 500px">
            <div class="card-body">
            @foreach ($reviews as $review)
            <!-- Comment-->
            <div class="border-bottom py-4 mt-2 mb-4">
                <div class="d-flex align-items-center pb-1 mb-2">
                    <div class="">
                        <h6 class="mb-0">{{ $review->user->name }}</h6>
                        {{-- <span class="fs-sm text-muted">02 hours ago</span> --}}
                    </div>
                </div>
                <p class="pb-2 mb-0">{{ $review->comment }}</p>
            </div>
            @endforeach
            </div>
        </div>
        @endif

        @auth
        <!-- Comment form-->
        <div class="card border-0 gray-simple pt-2 p-md-2 p-xl-3 p-xxl-4 mt-n3 mt-md-0">
            <div class="card-body">
                <h2 class="pb-2 pb-lg-3 pb-xl-4">Leave a review</h2>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form wire:submit="submitComment" class="row needs-validation g-4" novalidate="">
                    <div class="col-12">
                        <label class="form-label" for="comment">Comment</label>
                        <textarea wire:model="comment" name="comment" id="comment" class="form-control p-3" rows="4" placeholder="Type your comment here..." required></textarea>
                        @error('comment') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12">
                        <label for="rating" class="form-label">Rating</label>
                        <select wire:model="rating" name="rating" id="rating" class="form-select" placeholder="Certification rating">
                            <option value="5">5 - Excellent</option>
                            <option value="4">4 - Very Good</option>
                            <option value="3">3 - Good</option>
                            <option value="2">2 - Fair</option>
                            <option value="1">1 - Poor</option>
                        </select>
                        @error('rating') <span class="text-danger mt-3">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary px-lg-4" type="submit">Post Review</button>
                    </div>
                </form>
            </div>
        </div>
        @endauth
    </div>
</div>
