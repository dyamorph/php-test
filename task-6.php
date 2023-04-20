<?php
function convertString(string $input): string {
    function toUpperCase(string $str): string
    {
        return ucfirst($str);
    }
    $trimmedStr = trim(str_replace(['-','_',' '], ' ', $input));
    $array = explode(' ', $trimmedStr);
    return implode('', array_map('toUpperCase', $array));
}

print_r(convertString('              The quick-brown_fox jumps over the_lazy-dog       '));