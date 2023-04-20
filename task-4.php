<?php
function deleteElement(array $arr, int $position): array {
    array_splice($arr, $position, 1);
    return $arr;
}
print_r(deleteElement([1,2,3,4,5,45,231,123,314], 5));