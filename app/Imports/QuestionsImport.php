<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;

class QuestionsImport implements ToArray
{
    private $test_id;
    private $data;

    public function __construct(string $test_id)
    {
        $this->test_id = $test_id;
        $this->data = [];
    }

    /**
    * @param array $rows
    */
    public function array(array $rows)
    {
        array_shift($rows); // remove header row
        
        $questions = [];

        foreach ($rows as $index => $row) {
            if (!empty($row[0])) {
                $questions[] = [
                    'question' => $row[0],
                    'question_img' => $row[1],
                    'answer_type' => $row[2],
                    'option_a' => !empty($row[3]) ? $row[3] : null,
                    'option_b' => !empty($row[4]) ? $row[4] : null,
                    'option_c' => !empty($row[5]) ? $row[5] : null,
                    'option_d' => !empty($row[6]) ? $row[6] : null,
                    'option_e' => !empty($row[7]) ? $row[7] : null,
                    'option_f' => !empty($row[8]) ? $row[8] : null,
                    'option_g' => !empty($row[9]) ? $row[9] : null,
                    'correct_options' => $row[10],
                    'explanation' => $row[11],
                    'test_id' => $this->test_id
                ];
            }
        }

        $this->data['questions'] = $questions;
    }

    public function getArray(): array
    {
        return $this->data;
    }
}
