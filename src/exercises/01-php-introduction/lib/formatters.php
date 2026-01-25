<?php

function formatPhoneNumber($number) {
    $digits = preg_replace('/\D/', '', $number);

    if (strlen($digits) === 10) {
        return '(' . substr($digits, 0, 3) . ') ' . substr($digits, 3, 3) . '-' . substr($digits, 6);
    }

    else echo "$number not valid: must be 10 digits.";
}
?>