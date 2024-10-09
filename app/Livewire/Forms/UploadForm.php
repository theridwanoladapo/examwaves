<?php

namespace App\Livewire\Forms;

use App\Imports\QuestionsImport;
use App\Models\Question;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Maatwebsite\Excel\Facades\Excel;

class UploadForm extends Form
{
    #[Validate('required|exists:tests,id')]
    public string $test_id = '';

    #[Validate('required|file|mimes:xlsx,xls,csv')]
    public $file = '';

    public function import()
    {
        $this->validate();

        $import = new QuestionsImport($this->test_id);

        Excel::import($import, $this->file);

        $data = $import->getArray();

        $questions = $data['questions'];

        Question::insert($questions);

        $this->reset();
    }
}
