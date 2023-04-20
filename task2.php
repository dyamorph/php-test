<?php
$birthDate = '21-04-1996';
$birthDateArray = explode('-', $birthDate);
$birthTimestamp = mktime(0, 0, 0, $birthDateArray[1], $birthDateArray[0], date('Y'));
if ($birthTimestamp < time()) {
    $birthTimestamp = mktime(0, 0, 0, $birthDateArray[1], $birthDateArray[0], date('Y') + 1);
}
echo intval(($birthTimestamp - time()) / 86400);