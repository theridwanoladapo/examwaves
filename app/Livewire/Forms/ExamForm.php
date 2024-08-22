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
    public string $description = '';

    #[Validate('nullable|string')]
    public string $image_path = '';

    #[Validate('nullable|image|max:2048')]
    public $image = '';

    public function setExam(Exam $exam)
    {
        $this->exam = $exam;
 
        $this->name = $exam->name;
        $this->description = $exam->description;
        $this->image_path = $exam->image_path ?? '';
    }

    public function store()
    {
        $this->validate();

        if($this->image) {
            $img = $this->image->store(path: 'image/exams');
        }
        
        $this->image_path = $img;
        
        Exam::create($this->only([
            'image_path', 'name', 'description'
        ]));

        $this->reset();
    }

    public function update()
    {
        $this->validate();

        if($this->image) {
            $img = $this->image->store(path: 'image/exams');
        }
        
        $this->image_path = $img;

        $this->exam->update($this->only([
            'image_path', 'name', 'description'
        ]));
    }
}
