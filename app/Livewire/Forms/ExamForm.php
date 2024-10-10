<?php

namespace App\Livewire\Forms;

use App\Models\Exam;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ExamForm extends Form
{
    public ?Exam $exam;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|string')]
    public ?string $description = null;

    public string $isMenu = false;

    #[Validate('nullable|string')]
    public ?string $image_path = null;

    #[Validate('nullable|image|max:2048')]
    public $image = '';

    public function setExam(Exam $exam)
    {
        $this->exam = $exam;

        $this->name = $exam->name;
        $this->description = $exam->description;
        $this->isMenu = $exam->isMenu;
        $this->image_path = $exam->image_path ?? '';
    }

    public function store()
    {
        $this->validate();

        if($this->image) {
            $img = $this->image->store(path: 'image/exams');
        }

        $this->image_path = $img ?? null;

        Exam::create($this->only([
            'image_path', 'name', 'description', 'isMenu'
        ]));

        $this->reset();
    }

    public function update()
    {
        $this->validate();

        if($this->image) {
            $img = $this->image->store(path: 'image/exams');
        }

        $this->image_path = $img ?? $this->image_path;

        $this->exam->update($this->only([
            'image_path', 'name', 'description', 'isMenu'
        ]));
    }
}
