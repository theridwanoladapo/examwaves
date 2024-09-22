<?php

namespace App\Livewire\Forms;

use App\Models\Question;
use Livewire\Attributes\Validate;
use Livewire\Form;

class QuestionForm extends Form
{
    public ?Question $quiz;

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
    public string $exam_id = '';
    public string $certification_id = '';

    #[Validate('nullable|image|max:2048')]
    public $image = '';

    public function setQuestion(Question $quiz)
    {
        $this->quiz = $quiz;

        $this->answer_type = $quiz->answer_type;
        $this->image = $quiz->question_img;
        $this->question = $quiz->question;
        $this->option_a = $quiz->option_a;
        $this->option_b = $quiz->option_b;
        $this->option_c = $quiz->option_c;
        $this->option_d = $quiz->option_d;
        $this->option_e = $quiz->option_e;
        $this->option_f = $quiz->option_f;
        $this->option_g = $quiz->option_g;
        $this->correct_options = $quiz->correct_options;
        $this->explanation = $quiz->explanation;
        $this->test_id = $quiz->test_id;
        $this->certification_id = $quiz->test->certification_id;
        $this->exam_id = $quiz->test->certification->exam_id;
    }

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

    public function update()
    {
        $this->validate();

        if ($this->image) {
            $img = $this->image->store(path: 'image/questions');
        }

        $this->question_img = $img ?? $this->question_img;

        $this->quiz->update($this->only(
            'question', 'question_img', 'answer_type',
            'option_a', 'option_b', 'option_c',
            'option_d', 'option_e', 'option_f', 'option_g',
            'correct_options', 'explanation', 'test_id'
        ));

        session()->flash('status', 'Questions successfully updated.');
    }
}
