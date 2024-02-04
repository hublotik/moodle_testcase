<?php
function findmatch($array1, $array2)
{
    $commonElements = array_intersect($array1, $array2);
    foreach ($commonElements as $element) {
        echo $element . " ";
    }
}

$array1 = [1, 2, 3, 4, 5, 10];
$array2 = [4, 5, 6, 7, 8];

findmatch($array1, $array2);
