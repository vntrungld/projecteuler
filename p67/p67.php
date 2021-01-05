<?php

function execute(&$input, $row_idx = 0, $col_idx = 0)
{
    $current_value = $input[$row_idx][$col_idx];

    if ($row_idx === count($input) - 1) {
        return $current_value;
    }

    if ($current_value < 0) {
        return -$current_value;
    }

    $left_value = execute($input, $row_idx + 1, $col_idx);
    $right_value = execute($input, $row_idx + 1, $col_idx + 1);

    $sum = $current_value + ($left_value < $right_value ? $right_value : $left_value);
    $input[$row_idx][$col_idx] = -($sum);

    return $sum;
}

$file_content = file_get_contents(__DIR__ . '/triangle.txt');

$input = array_map(function ($line) {
    return array_map(function ($block) {
        return intval($block);
    }, explode(' ', $line));
}, explode("\n", $file_content));

array_pop($input); // remove last line;

var_dump(execute($input));
