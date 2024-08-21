<?php

namespace App\Livewire\Forms;

use App\Models\Exam;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class ExamForm extends Form
{
    use WithFileUploads;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|string')]
    public string $description = '';

    #[Validate('nullable|string')]
    public string $image_path = '';

    #[Validate('nullable|image|max:2048')]
    public $image = '';

    public function store()
    {
        $this->validate();

        if($this->image) {
            $img = $this->image->store(path: 'image/exams');
        }
        
        $this->image_path = $img;
        
        Exam::create($this->only(['image_path', 'name', 'description']));

        $this->reset();
    }
}
