<?php
function arr_sort($array){
    sort($array);
    foreach ($array as $value) {
        $sorted_arr[] = $value;
    }
    return $sorted_arr;
}

$arr = [5, 2, 8, 1, 3];
print_r(arr_sort($arr));