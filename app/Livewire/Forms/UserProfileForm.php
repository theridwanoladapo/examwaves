<?php

namespace App\Livewire\Forms;

use App\Models\UserProfile;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserProfileForm extends Form
{
    public ?UserProfile $userProfile;

    #[Validate('nullable|string')]
    public string $firstname = '';

    #[Validate('nullable|string')]
    public string $lastname = '';

    #[Validate('nullable|string')]
    public string $headline = '';

    #[Validate('nullable|string')]
    public string $biography = '';

    public function setUserProfile()
    {
        $userProfile = UserProfile::where('user_id', auth()->user()->id)->first();

        $this->userProfile = $userProfile;

        $this->firstname = $userProfile->firstname;
        $this->lastname = $userProfile->lastname;
        $this->headline = $userProfile->headline;
        $this->biography = $userProfile->biography;
    }

    public function update()
    {
        $this->validate();

        $this->userProfile->update($this->only([
            'firstname', 'lastname', 'headline', 'biography'
        ]));
    }
}
