<?php
function printNumbers(int $first, int $second): void {
    echo $first . " ";
    if ($first == $second) {
        return;
    }
    if ($first < $second) {
        printNumbers($first + 1, $second);
    } else {
        printNumbers($first - 1, $second);
    }
}
printNumbers(9,4);
echo "\n";
printNumbers(4,9);