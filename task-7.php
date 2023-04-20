<?php
function addNums(string $firstNum, string $secondNum): string {
    $firstNumLength = strlen($firstNum);
    $secondNumLength = strlen($secondNum);
    $maxLength = max($firstNumLength, $secondNumLength);

    $firstNum = str_pad($firstNum, $maxLength, '0', STR_PAD_LEFT);
    $secondNum = str_pad($secondNum, $maxLength, '0', STR_PAD_LEFT);

    $result = '';
    $carry = 0;

    for ($i = $maxLength - 1; $i >= 0; $i--) {
        $sum = (int) $firstNum[$i] + (int) $secondNum[$i] + $carry;
        $carry = floor($sum / 10);
        $result = ($sum % 10) . $result;
    }
    if ($carry) {
        $result = $carry . $result;
    }
    return ltrim($result, '0');
}
function findFibonacci(int $n): string {
    $previousNumber = '0';
    $currentNumber = '1';
    while (strlen($currentNumber) < $n) {
        $next_num = addNums($previousNumber, $currentNumber);
        $previousNumber = $currentNumber;
        $currentNumber = $next_num;
    }
    return $currentNumber;
}

echo findFibonacci(100);