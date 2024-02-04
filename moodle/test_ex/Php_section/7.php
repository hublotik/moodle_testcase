<?php
function check_if_pal($string)
{
    $string = strtolower(preg_replace('/[^A-Za-z0-9]/', '', $string));
    $reverseString = strrev($string);

    if ($string === $reverseString) {
        return 'является палиндромом';
    } else {
        return 'не является палиндромом';
    }
}

$inputString = "упала на лапу";
echo check_if_pal($inputString);

