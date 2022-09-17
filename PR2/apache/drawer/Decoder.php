<?php
class Decoder {
    const RED_COLOR_MASK   = 0b1100000000000000;
    const GREEN_COLOR_MASK = 0b0011000000000000;
    const BLUE_COLOR_MASK  = 0b0000110000000000;
    const SHAPE_MASK       = 0b0000001100000000;
    const WIDTH_MASK       = 0b0000000011110000;
    const HEIGHT_MASK      = 0b0000000000001111;
    
    private static $SHAPES_IMAGE = array(
        0b0000000000=>"circle",
        0b0100000000=>"rectangle",
        0b1000000000=>"rounded_rectangle",
        0b1100000000=>"ellipse"
    );

    private static function getParameter(int $number, int $mask): int
    {
        return $number & $mask;
    }

    public static function getParameters(int $inputNumber): array
    {
        $shape = self::$SHAPES_IMAGE[Decoder::getParameter($inputNumber,self::SHAPE_MASK)];
        $height = Decoder::getParameter($inputNumber, self::HEIGHT_MASK);
        $width = Decoder::getParameter($inputNumber, self::WIDTH_MASK);
        $blue = Decoder::getParameter($inputNumber, self::BLUE_COLOR_MASK) % 255;
        $green = Decoder::getParameter($inputNumber, self::GREEN_COLOR_MASK) % 255;
        $red = Decoder::getParameter($inputNumber, self::RED_COLOR_MASK) % 255;

        return [
            "shape" => $shape,
            "height" => $height,
            "width" => $width,
            "blue"=> $blue,
            "green" => $green,
            "red" => $red
        ];
    }
}
