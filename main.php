<?php

require_once __DIR__ . '/PasswordGenerator.php';

use function hexlet\code\generatePassword;

// Готовый помощник: печатает значение и переносит строку.
function println(string $value): void
{
    echo $value . PHP_EOL;
}

println(generatePassword(8, 1));
println(generatePassword(12, 123));
println(generatePassword(12, 123, useSpecial: true));
println(generatePassword(8, 1, useUppercase: false, useDigits: false));
