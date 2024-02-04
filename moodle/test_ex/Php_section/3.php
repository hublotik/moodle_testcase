<?php
function revert_str($str){
    $reversedString = strrev($str);
    echo $reversedString;
}

revert_str('1234567abc');

