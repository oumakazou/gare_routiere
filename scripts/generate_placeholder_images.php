<?php
$out = __DIR__ . '/../public/images/bus-station.jpg';
$w = 1200;
$h = 700;
$img = imagecreatetruecolor($w, $h);
if (!function_exists('imagejpeg')) {
    echo "GD extension not available\n";
    exit(1);
}
for ($y = 0; $y < $h; $y++) {
    $r = 12 + intval(20 * $y / $h);
    $g = 60 + intval(40 * $y / $h);
    $b = 110 + intval(80 * $y / $h);
    $col = imagecolorallocate($img, $r, $g, $b);
    imageline($img, 0, $y, $w, $y, $col);
}
$white = imagecolorallocate($img, 255, 255, 255);
$yellow = imagecolorallocate($img, 255, 215, 0);
imagefilledrectangle($img, 150, 420, 1050, 560, $white);
imagefilledrectangle($img, 180, 380, 1030, 520, $yellow);
imagefilledrectangle($img, 220, 420, 940, 540, $white);
imagefilledrectangle($img, 300, 440, 420, 520, $white);
imagefilledrectangle($img, 780, 440, 900, 520, $white);
imagefilledrectangle($img, 210, 500, 260, 560, imagecolorallocate($img, 20, 20, 20));
imagefilledrectangle($img, 850, 500, 900, 560, imagecolorallocate($img, 20, 20, 20));
imagestring($img, 5, 60, 40, 'horseRide', $white);
imagestring($img, 3, 180, 520, 'Bus station placeholder', $white);
imagejpeg($img, $out, 85);
imagedestroy($img);

$out2 = __DIR__ . '/../public/images/logo-bus.png';
$w2 = 400;
$h2 = 400;
$img2 = imagecreatetruecolor($w2, $h2);
if (!function_exists('imagepng')) {
    echo "GD PNG not available\n";
    exit(1);
}
imagesavealpha($img2, true);
$trans = imagecolorallocatealpha($img2, 0, 0, 0, 127);
imagefill($img2, 0, 0, $trans);
$bg2 = imagecolorallocate($img2, 9, 64, 124);
imagefilledrectangle($img2, 0, 0, $w2, $h2, $bg2);
$white2 = imagecolorallocate($img2, 255, 255, 255);
$blue = imagecolorallocate($img2, 75, 192, 255);
imagefilledrectangle($img2, 50, 220, 350, 300, $white2);
imagefilledrectangle($img2, 70, 180, 330, 260, $blue);
imagefilledrectangle($img2, 90, 140, 310, 180, $white2);
imagefilledrectangle($img2, 120, 100, 280, 140, $blue);
imagefilledellipse($img2, 140, 320, 70, 70, $white2);
imagefilledellipse($img2, 260, 320, 70, 70, $white2);
imagefilledrectangle($img2, 110, 255, 290, 280, $white2);
imagestring($img2, 5, 120, 60, 'horseRide', $white2);
imagepng($img2, $out2);
imagedestroy($img2);

echo "generated\n";
