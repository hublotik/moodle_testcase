<?php
function checkEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "является emal-адресом";
    } else {
        return "не является emal-адресом";
    }
}

$email = "golubev-petya@mail.ru";

echo checkEmail($email);
