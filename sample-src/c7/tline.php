<?php
//
// 樹木曲線を描画
//
$width  = 1260;
$height = 1080;

$angle = 270;
$nx = $cx;
$ny = $height;

initCanvas($width, $height);

imagepng($img, "tline.png");



// 位置の移動
function move($x, $y) {
  global $nx, $ny;
  $nx = $x; $ny = $y;
}
// 進む
function forward($dist, $drawing = true) {
  global $nx, $ny, $angle;
  $x = cos(deg2rad($angle)) * $dist;
  $y = sin(deg2rad($angle)) * $dist;
  $nx += $x;
  $ny += $y;
  if (!$drawing) return;
  
}
// 向きを変える
function turn($d) {
  global $angle;
  $angle = ($angle + $d) % 360;
  if ($angle < 0) $angle += 360;
}

function initCanvas($w, $h) {
  global $img, $black;
  $img = imagecreatetruecolor($w, $h);
  $white = imagecolorallocate($img, 255,255,255);
  $black = imagecolorallocate($img, 0, 0, 0);
  imagefilledrectangle($img, 0, 0, $w, $h, $white);
  imagerectangle($img, 0, 0, $w-1, $h-1, $black);
}


echo '<img src="tline.png">';

