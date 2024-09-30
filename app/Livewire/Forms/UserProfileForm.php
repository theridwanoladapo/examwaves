<?php

namespace App\Livewire\Forms;

use App\Models\UserProfile;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserProfileForm extends Form
{
    public ?UserProfile $userProfile;

    #[Validate('nullable|string')]
    public ?string $firstname = null;

    #[Validate('nullable|string')]
    public ?string $lastname = null;

    #[Validate('nullable|string')]
    public ?string $headline = null;

    #[Validate('nullable|string')]
    public ?string $biography = null;

    public function setUserProfile()
    {
        $userProfile = UserProfile::firstOrCreate(['user_id' => auth()->user()->id]);

        $this->userProfile = $userProfile;

        $this->firstname = $userProfile->firstname ?? null;
        $this->lastname = $userProfile->lastname ?? null;
        $this->headline = $userProfile->headline ?? null;
        $this->biography = $userProfile->biography ?? null;
    }

    public function update()
    {
        $this->validate();

        $this->userProfile->update($this->only([
            'firstname', 'lastname', 'headline', 'biography'
        ]));
    }
}
