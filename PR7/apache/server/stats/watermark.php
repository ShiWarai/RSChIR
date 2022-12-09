<?php
function add_watermark($image_name): void
{
    $watermark = 'images/watermark.png';
    list($width, $height) = getimagesize($watermark);

    $image = imagecreatefromstring(file_get_contents($image_name));
    $watermark = imagecreatefromstring(file_get_contents($watermark));

    imagealphablending($watermark, false);
    imagesavealpha($watermark, true);
    $alpha = round(64); // convert to [0-127]

    for ($x = 0; $x < $width; $x++) {
        for ($y = 0; $y < $height; $y++) {
            $rgb = imagecolorat($watermark, $x, $y);

            $r = ($rgb >> 16) & 0xff;
            $g = ($rgb >> 8) & 0xff;
            $b = $rgb & 0xff;

            $col = imagecolorallocatealpha($watermark, $r, $g, $b, $alpha);

            imagesetpixel($watermark, $x, $y, $col);
        }
    }

    imagecopy($image, $watermark, 64, 64, 0, 0, $width, $height);
    imagepng($image, $image_name);
}
