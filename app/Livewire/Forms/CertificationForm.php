<?php

namespace App\Livewire\Forms;

use App\Models\Certification;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CertificationForm extends Form
{
    public ?Certification $certification;

    #[Validate('required|string|max:255')]
    public string $title = '';

    #[Validate('nullable|string|max:255')]
    public ?string $code = null;

    #[Validate('nullable|string')]
    public ?string $description = null;

    #[Validate('nullable|string')]
    public ?string $image_path = null;

    #[Validate('nullable|integer')]
    public ?string $rating = null;

    #[Validate('required|numeric')]
    public string $price = '';

    #[Validate('required|exists:exams,id')]
    public string $exam_id = '';

    #[Validate('nullable|image|max:2048')]
    public $image = '';

    public function setCertification(Certification $certification)
    {
        $this->certification = $certification;

        $this->title = $certification->title;
        $this->code = $certification->code ;
        $this->description = $certification->description;
        $this->image_path = $certification->image_path ?? '';
        $this->rating = $certification->rating;
        $this->price = $certification->price;
        $this->exam_id = $certification->exam_id;
    }

    public function store()
    {
        $this->validate();

        if($this->image) {
            $img = $this->image->store(path: 'image/certifications');
        }

        $this->image_path = $img ?? null;

        Certification::create($this->only([
            'title',
            'code',
            'description',
            'image_path',
            'rating',
            'price',
            'exam_id'
        ]));

        $this->reset();
    }

    public function update()
    {
        $this->validate();

        if($this->image) {
            $img = $this->image->store(path: 'image/certifications');
        }

        $this->image_path = $img ?? $this->image_path;

        $this->certification->update($this->only([
            'title',
            'code',
            'description',
            'image_path',
            'rating',
            'price',
            'exam_id'
        ]));
    }
}
