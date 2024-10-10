<?php

namespace App\Livewire\Forms;

use App\Models\Test;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TestForm extends Form
{
    public ?Test $test;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|integer')]
    public string $time_limit = '';

    #[Validate('required|integer')]
    public string $pass_percent = '';

    #[Validate('required|exists:certifications,id')]
    public string $certification_id = '';

    public function setTest(Test $test)
    {
        $this->test = $test;

        $this->name = $test->name;
        $this->time_limit = $test->time_limit;
        $this->pass_percent = $test->pass_percent;
        $this->certification_id = $test->certification_id;
    }

    public function store()
    {
        $this->validate();

        Test::create($this->only([
            'name', 'time_limit', 'pass_percent', 'certification_id'
        ]));

        $this->reset();
    }

    public function update()
    {
        $this->validate();

        $this->test->update($this->only([
            'name', 'time_limit', 'pass_percent', 'certification_id'
        ]));

        $this->reset();
    }
}
