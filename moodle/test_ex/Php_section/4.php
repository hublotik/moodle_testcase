<?php
function finavg($nums)
{
    $sum = array_sum($nums);
    $count = count($nums);
    if ($count > 0) {
        return $sum / $count;
    } else {
        return 0;
    }
}

$nums = [2, 4, 6, 8, 10];
$average = finavg($nums);
echo "ср. арифм. равно: " . $average;
