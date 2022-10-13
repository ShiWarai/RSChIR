<?php
function execCommand($command)
{
    $last_result = array();

    if (!exec($command, $last_result))
        $last_result = "!!! Error !!!";

    echo implode("</br>", $last_result);
}
