<?php

use App\Models\Exam;
use App\Models\Question;
use App\Models\Test;

// answer type
if (! function_exists('answer_type_human')) {
    function answer_type_human($type)
    {
        if ($type == 'one_opt') {
            $result = 'One Correct Answer';
        }
        if ($type == 'multi_opt') {
            $result = 'Multiple Correct Answer';
        }
        if ($type == 'bool') {
            $result = 'True/False';
        }
        if ($type == 'typed') {
            $result = 'Typed Answer';
        }

        return $result;
    }
}


// exam question count
if (! function_exists('exam_question_count')) {
    function exam_question_count($exam_id)
    {
        $tests = Test::where('certification_id', $exam_id)->get();

        if (! $tests) return 0;

        $q_count = 0;
        foreach ($tests as $test) {
            $test_id = $test->id;
            $count = Question::where('test_id', $test_id)->count();
            $q_count += $count;
        }

        return $q_count;
    }
}

// exam test count
if (! function_exists('exam_test_count')) {
    function exam_test_count($exam_id)
    {
        $count = Test::where('certification_id', $exam_id)->count();

        return $count;
    }
}

// test question count
if (! function_exists('test_question_count')) {
    function test_question_count($test_id)
    {
        $count = Question::where('test_id', $test_id)->count();

        return $count;
    }
}

// score percentage
if (! function_exists('score_percent')) {
    function score_percent($test_id, $score)
    {
        $test_count = Question::where('test_id', $test_id)->count();

        $percent = round(($score / $test_count) * 100);

        return $percent;
    }
}

// exam provider name
if (! function_exists('exam_provider_name')) {
    function exam_provider_name($id)
    {
        $exam = Exam::find($id);
        $exam_name = $exam->name;

        return $exam_name;
    }
}

// example
if (! function_exists('example')) {
    function example($args)
    {

    }
}
