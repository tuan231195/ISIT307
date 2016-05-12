<?php
$gfx = imagecreatefromjpeg("img.jpg");

$width = imagesx($gfx);
$height = imagesy($gfx);


$red = imagecolorallocate($gfx, 255, 0, 0);
$blue = imagecolorallocate($gfx, 0, 0, 255);
$green = imagecolorallocate($gfx, 0, 255, 0);
$yellow = imagecolorallocate($gfx, 255, 255, 0);
$white = imagecolorallocate($gfx, 255, 255, 255);

$string = "HELLO";

imagefilledrectangle($gfx,$width - 100 , $height - 100, $width, $height, $red);
imagefilledrectangle($gfx,0,0, 100, 100, $blue);
imagefilledrectangle($gfx,$width - 100, 0,  $width, 100 , $green);
imagefilledrectangle($gfx,0 , $height - 100,  100, $height , $yellow);
imagestring($gfx, 5, $width/2, $height/2, $string, $white);


// Let the browser know that we are going to output this as a PNG
header('Content-type: image/png');
// And then output our new image:
imagepng($gfx);