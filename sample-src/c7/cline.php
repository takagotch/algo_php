<?php
//
// C曲線を描画
//
$width  = 1260;
$height = 1080;
$cx = $width  / 3;
$cy = $height / 3;
$nx = 0;
$ny = 0;
$maxlen = 9;

initCanvas($width, $height);
c_curve($cx, $cy/3);
imagepng($img, "cline.png");

function initCanvas($w, $h) {
  global $img, $black;
  $img = imagecreatetruecolor($w, $h);
  $white = imagecolorallocate($img, 255,255,255);
  $black = imagecolorallocate($img, 0, 0, 0);
  imagefilledrectangle($img, 0, 0, $w, $h, $white);
  imagerectangle($img, 0, 0, $w-1, $h-1, $black);
}

function c_curve($x, $y) {
  global $maxlen;
  if ($x * $x + $y * $y < $maxlen * $maxlen) {
    rel_line($x, $y);
    return;
  }
  c_curve(($x - $y)/2, ($y + $x)/2);
  c_curve(($x + $y)/2, ($y - $x)/2);
}

function rel_line($x, $y) {
  global $cx, $cy, $nx, $ny;
  global $img, $black;
  $x += $nx;
  $y += $ny;
  $x1 = $cx + $nx;
  $y1 = $cy + $ny;
  $x2 = $cx + $x;
  $y2 = $cy + $y;
  imageline($img, $x1,$y1, $x2,$y2, $black); 
  $nx = $x;
  $ny = $y;
}
echo '<img src="cline.png">';

