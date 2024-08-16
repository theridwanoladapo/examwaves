<?php

namespace App\Livewire\Forms;

use App\Models\Exam;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AddExamForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|string')]
    public string $description = '';

    #[Validate('nullable|image')]
    public string $image_path = '';

    public function store()
    {
        $this->validate();

        Exam::create($this->all());

        $this->reset();
    }
}
