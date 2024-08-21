<?php

namespace App\Livewire\Forms;

use App\Models\Certification;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CertificationForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $title = '';

    #[Validate('required|string|max:255')]
    public string $code = '';

    #[Validate('nullable|string')]
    public string $description = '';

    #[Validate('nullable|string')]
    public string $image_path = '';

    #[Validate('nullable|string')]
    public string $rating = '';

    #[Validate('required|numeric')]
    public string $price = '';

    #[Validate('required|exists:exams,id')]
    public string $exam_id = '';

    
    #[Validate('nullable|image|max:2048')]
    public $image = '';

    public function store()
    {
        $this->validate();

        if($this->image) {
            $img = $this->image->store(path: 'image/certifications');
        }

        $this->image_path = $img;

        Certification::create($this->only([
            'title',
            'code',
            'description',
            'rating',
            'price',
            'exam_id'
        ]));

        $this->reset();
    }
}
