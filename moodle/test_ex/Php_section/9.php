<?php
function multiply_table()
{
    for ($i = 1; $i <= 10; $i++) {
        for ($j = 1; $j <= 10; $j++) {
            echo $i * $j . "\n";
        }
    }
}
multiply_table();