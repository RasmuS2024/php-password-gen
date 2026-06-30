<?php

namespace hexlet\code;

const LOWERCASE = 'abcdefghijklmnopqrstuvwxyz';
const UPPERCASE = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
const DIGITS = '0123456789';
const SPECIAL = '!@#$%^&*';


function generatePassword(int $length, int $seed, bool $useUppercase = true, bool $useDigits = true, bool $useSpecial = false): string
{
    // Крайний случай: длина <= 0
    if ($length <= 0) {
        return '';
    }
    
    // Приводим seed к рабочему виду
    $seed = abs($seed) % 2147483647;
    if ($seed === 0) {
        $seed = 1;
    }
    
    $alphabet = LOWERCASE;
    
    if ($useUppercase) {
        $alphabet .= UPPERCASE;
    }
    
    if ($useDigits) {
        $alphabet .= DIGITS;
    }

    if ($useSpecial) {
        $alphabet .= SPECIAL;
    }
    
    $alphabetLength = strlen($alphabet);
    $result = '';
    $current = $seed;
    
    for ($i = 0; $i < $length; $i++) {
        $current = nextRandom($current);
        $index = $current % $alphabetLength;
        $result .= $alphabet[$index];
    }
    
    return $result;
}


function nextRandom(int $number): int
{
    return (16807 * $number) % 2147483647;
}


function checkPassword(string $password): string
{
    $score = 0;
    
    // 1. Длина не меньше 8 символов
    if (strlen($password) >= 8) {
        $score++;
    }
    
    // Разбиваем строку на символы для проверки
    $chars = str_split($password);
    $hasLowercase = false;
    $hasUppercase = false;
    $hasDigit = false;
    $hasSpecial = false;
    
    foreach ($chars as $char) {
        // 2. Есть строчная латинская буква
        if ($char >= 'a' && $char <= 'z') {
            $hasLowercase = true;
        }
        // 3. Есть ПРОПИСНАЯ латинская буква
        elseif ($char >= 'A' && $char <= 'Z') {
            $hasUppercase = true;
        }
        // 4. Есть цифра
        elseif ($char >= '0' && $char <= '9') {
            $hasDigit = true;
        }
        // 5. Есть спецсимвол
        elseif (str_contains(SPECIAL, $char)) {
            $hasSpecial = true;
        }
    }
    
    // Добавляем баллы за найденные признаки
    if ($hasLowercase) {
        $score++;
    }
    if ($hasUppercase) {
        $score++;
    }
    if ($hasDigit) {
        $score++;
    }
    if ($hasSpecial) {
        $score++;
    }
    
    // Определяем вердикт
    if ($score <= 2) {
        $verdict = 'Слабый';
    } elseif ($score === 3) {
        $verdict = 'Средний';
    } elseif ($score === 4) {
        $verdict = 'Надёжный';
    } else {
        $verdict = 'Очень надёжный';
    }
    
    return "{$verdict} пароль (оценка {$score} из 5)";
}
