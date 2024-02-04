<?php
function is_int_function($num){
    if (is_integer($num)){
        echo 'Число является простым';
    } else {
        echo 'Число не является простым';
    }
}

is_int_function(1.1);
