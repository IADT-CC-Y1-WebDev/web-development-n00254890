<?php
function shout($text) {
    return strtoupper($text) . "!";
}

function whisper($text) {
    return strtolower($text) . "...";
}

function reverse_text($text) {
    return strrev($text);
}
?>
