<?php

function quickSort($array) {
    if (count($array) < 2) {
        return $array;
    }
    $target = $array[0];
    $less = array(); $equal = array($target); $greater = array();
    for ($i = 1; $i < count($array); $i++) {
        $elem = $array[$i];
        if ($elem > $target) {
            $greater[] = $elem;
        } elseif ($elem < $target) {
            $less[] = $elem;
        } else {
            $equal[] = $elem;
        }
    }
    $less = quickSort($less);
    $greater = quickSort($greater);
    return array_merge($less, $equal, $greater);
}
