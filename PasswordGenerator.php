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
