<?php

// answer type
if (! function_exists('answer_type_human')) {
    function answer_type_human($type) {
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
