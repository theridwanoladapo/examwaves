<?php

namespace App\Livewire\Forms;

use App\Models\Question;
use Livewire\Attributes\Validate;
use Livewire\Form;

class QuestionForm extends Form
{
    #[Validate('required|string')]
    public string $question = '';

    #[Validate('nullable|string')]
    public string $question_img = '';

    #[Validate('required|string')]
    public string $answer_type = '';

    #[Validate('nullable|string')]
    public ?string $option_a = null;

    #[Validate('nullable|string')]
    public ?string $option_b = null;

    #[Validate('nullable|string')]
    public ?string $option_c = null;

    #[Validate('nullable|string')]
    public ?string $option_d = null;

    #[Validate('nullable|string')]
    public ?string $option_e = null;

    #[Validate('nullable|string')]
    public ?string $option_f = null;

    #[Validate('nullable|string')]
    public ?string $option_g = null;

    #[Validate('required|string')]
    public ?string $correct_options = '';

    #[Validate('nullable|string')]
    public ?string $explanation = null;

    #[Validate('required|exists:tests,id')]
    public string $test_id = '';

    #[Validate('nullable|image|max:2048')]
    public $image = '';

    public function store()
    {
        $this->validate();

        if ($this->image) {
            $img = $this->image->store(path: 'image/questions');
        }

        $this->question_img = $img ?? '';

        Question::create($this->only(
            'question', 'question_img', 'answer_type',
            'option_a', 'option_b', 'option_c',
            'option_d', 'option_e', 'option_f', 'option_g',
            'correct_options', 'explanation', 'test_id'
        ));

        session()->flash('status', 'Questions successfully added.');

        $this->reset();
    }
}
