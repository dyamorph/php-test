<?php
function greaterWithIf(int $inputNumber): string
{
    if ($inputNumber > 30) {
        return "More than 30";
    } elseif ($inputNumber > 20) {
        return "More than 20";
    } elseif ($inputNumber > 10) {
        return "More than 10";
    } else {
        return "Equal or less than 10";
    }
}

echo greaterWithIf(40) . "\n";

function greaterWithSwitch(int $inputNumber): string
{
    switch ($inputNumber) {
        case ($inputNumber > 30):
            return "More than 30";
        case ($inputNumber > 20):
            return "More than 20";
        case ($inputNumber > 10):
            return "More than 10";
        default:
            return "Equal or less than 10";
    }
}
echo greaterWithSwitch(10) . "\n";

function greaterWithTernary(int $inputNumber): string
{
    return $inputNumber > 30 ? "More than 30" : ($inputNumber > 20 ? "More than 20" : (($inputNumber > 10) ? "More than 10" : "Equal or less than 10"));
}

echo greaterWithTernary(39) . "\n";
