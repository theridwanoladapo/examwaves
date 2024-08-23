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

    #[Validate('nullable|integer')]
    public string $time_limit = '';

    #[Validate('required|exists:certifications,id')]
    public string $certification_id = '';

    public function setCertification(Test $test)
    {
        $this->test = $test;
 
        $this->name = $test->name;
        $this->time_limit = $test->time_limit;
        $this->certification_id = $test->certification_id;
    }

    public function store()
    {
        $this->validate();

        Test::create($this->only([
            'name', 'time_limit', 'certification_id'
        ]));

        session()->flash('status', 'Test successfully added.');

        $this->reset();
    }

    public function update()
    {
        $this->validate();

        $this->test->update($this->only([
            'name', 'time_limit', 'certification_id'
        ]));

        session()->flash('status', 'Test successfully updated.');

        $this->reset();
    }
}
