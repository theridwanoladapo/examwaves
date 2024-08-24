<?php 

// answer type
if (! function_exists('answer_type_human')) {
    function answer_type_human($type) {
        if ($type == 'one_opt') {
            $result = 'One Answer';
        }
        if ($type == 'multi_opt') {
            $result = 'Multi Answer';
        }
        if ($type == 'yes_no') {
            $result = 'Yes/No';
        }
        if ($type == 'typed') {
            $result = 'Typed Answer';
        }

        return $result;
    }
}