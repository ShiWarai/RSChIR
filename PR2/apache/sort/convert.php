<?php

function convert($string) {
    $content = preg_replace("/[^0-9.-]/", " ", $string);
    $content = preg_replace('/\s+/', ' ', $content);
    $pieces = explode(" ", $content);

    return array_filter ($pieces, function ($item) {
        return is_numeric($item); });
}