<?php

use App\Livewire\Forms\UserProfileForm;

use function Livewire\Volt\{mount, state};
use function Livewire\Volt\form;
use function Livewire\Volt\layout;

state(['firstname', 'lastname', 'headline', 'biography']);

form(UserProfileForm::class);

layout('layouts.app');

mount(function () {
    $this->form->setUserProfile();
    $this->firstname = $this->form->firstname;
    $this->lastname = $this->form->lastname;
    $this->headline = $this->form->headline;
    $this->biography = $this->form->biography;
});

$updateProfile = function () {

    $this->form->firstname =  $this->firstname ?? '';
    $this->form->lastname =  $this->lastname ?? '';
    $this->form->headline =  $this->headline ?? '';
    $this->form->biography =  $this->biography ?? '';

    $this->form->update();

    return $this->redirectRoute('profile', navigate: true);
}

?>

<div>
    <div class="dash-wrapsw card border-0 rounded-4 py-4 mb-4">
        <div class="card-headers border-0 py-4 px-4 pb-0 pt-1">
            <h4><i class="fa-solid fa-user text-primary me-2"></i>Profile info</h4>
        </div>
        <div class="card-body px-4">

            <form wire:submit="updateProfile">
                {{-- <div class="d-flex align-items-center">
                    <div class="author-fluid me-3">
                        <img src="assets/img/team-1.jpg" class="img-fluid circle" width="100" alt="Img">
                    </div>
                    <div class="author-fluid">
                        <button class="btn btn-md btn-primary me-2 my-1" type="button">Upload New</button>
                        <button class="btn btn-md btn-light-danger me-2 my-1" type="button"><i class="fa-solid fa-trash me-2"></i>Delete</button>
                    </div>
                </div> --}}

                <div class="row g-3 g-sm-4 mt-0 mt-lg-2">

                    <div class="col-sm-6">
                        <label class="form-label" for="firstname">First Name</label>
                        <input wire:model="firstname" type="text" id="firstname" class="form-control">
                    </div>

                    <div class="col-sm-6">
                        <label class="form-label" for="lastname">Last Name</label>
                        <input wire:model="lastname" type="text" id="lastname" class="form-control">
                    </div>

                    <div class="col-sm-12">
                        <label class="form-label" for="headline">Headline</label>
                        <input wire:model="headline" type="text" id="headline" class="form-control">
                    </div>

                    <div class="col-sm-12">
                        <label class="form-label">Biography</label>
                        <div wire:ignore>
                            <textarea wire:model="biography" name="biography" id="biography" class="form-control" placeholder="Biography"></textarea>
                        </div>
                    </div>

                </div>

                <div class="d-flex justify-content-start pt-3">
                    <button class="btn btn-primary me-3" type="submit">Save changes</button>
                    {{-- <button class="btn btn-dark" type="button">Cancel</button> --}}
                </div>
            </form>

        </div>
    </div>
</div>

@script
<script>
    $(function () {
        $('#biography').summernote({
            placeholder: 'Write biography here...',
            tabsize: 4,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['help']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('biography', contents);
                }
            }
        });
    });
</script>
@endscript
