<?php

require_once __DIR__ . '/PasswordGenerator.php';

use function hexlet\code\generatePassword;
use function hexlet\code\checkPassword;

function println(string $value): void
{
    echo $value . PHP_EOL;
}

println('== Генерация паролей ==');
println('буквы и цифры:    ' . generatePassword(12, 123));
println('со спецсимволами: ' . generatePassword(16, 7, useSpecial: true));

println('');
println('== Проверка надёжности ==');
println('abc        -> ' . checkPassword('abc'));
println('abcdef1234 -> ' . checkPassword('abcdef1234'));
println('Abcdef123! -> ' . checkPassword('Abcdef123!'));
