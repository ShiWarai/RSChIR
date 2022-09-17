<?php
function draw($shape_parameters) {
    $width = $shape_parameters["width"] + 128;
    $height = $shape_parameters["height"] + 128;
    $radius = ($width<=$height) ? $width/2 : $height/2;
    $fillColor = "rgb(".$shape_parameters["red"].",".$shape_parameters["green"].",".$shape_parameters["blue"].")";

    $x = 0;
    $y = 0;
    $figure = "";
    switch($shape_parameters["shape"]){
        case "circle":
            $x = $width;
            $y = $height;
            $figure = "<circle cx=".$radius." cy=".$radius." r=".$radius." fill=".$fillColor.">";
            break;
        case "rectangle":
            $x = $width;
            $y = $height;
            $figure = "<rect width=".$width." height=".$height." fill".$fillColor.">";
            break;
        case "rounded_rectangle":
            $x = $width;
            $y = $height;
            $figure ="<rect rx=".$radius." ry=".$radius." width=".$width." height=".$height." fill=".$fillColor.">";
            break;
        case "ellipse":
            $x = ($width / 2 + $radius) * 2;
            $y = ($height / 2 + $radius) * 2;
            $figure ="<ellipse cx=".($x / 2)." cy=".($y / 2)." rx=".($width / 2 + $radius)." ry= ".($height / 2 + $radius)." fill=".$fillColor.">";
            break;
        default:
            break;
    }

    echo '<svg width="'.$x.'" height="'.$y.'">'.$figure;
}