<?php
function num_sum($num1, $num2) {
    $result = $num1 + $num2;
    return $result;
}

$number1 = 999;
$number2 = 999;

$res = num_sum($number1, $number2);
echo "Сумма числа {$number1} и {$number2} равна: {$res}";