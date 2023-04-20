<?php
function addDigits(int $number): int {
    while ($number >= 9) {
        $array = str_split($number);
        $arraySum = array_sum($array);
        $number = $arraySum;
    }
    return $number;
}

echo addDigits(5689);