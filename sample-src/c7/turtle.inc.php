<?php
// タートルグラフィック用ライブラリ

// キャンバス(GD)の初期化
function initCanvas($w, $h) {
  global $img, $black;
  global $angle, $nx, $ny, $pen_color;
  // GDイメージの初期化
  $img = imagecreatetruecolor($w, $h);
  $black = rgb(0, 0, 0);
  imagefilledrectangle($img, 0, 0, $w, $h, rgb(255,255,255));
  imagerectangle($img, 0, 0, $w-1, $h-1, $black);
  // タートルのパラメータを初期化
  $angle = $nx = $ny = 0;
  $pen_color = $black;
  return $img;
}
// GD用の色番号の取得
function rgb($r, $g, $b) {
  global $img;
  return imagecolorallocate($img, $r, $g, $b);
}

// 位置の移動
function move($x, $y) {
  global $nx, $ny;
  $nx = $x; $ny = $y;
}
// 進む
function forward($dist, $isPenDown=true, $color=null) {
  global $nx, $ny, $angle;
  global $img, $pen_color;
  $x = cos(deg2rad($angle)) * $dist;
  $y = sin(deg2rad($angle)) * $dist;
  $dx = $nx + $x;
  $dy = $ny + $y;
  if ($isPenDown) {
    if ($color == null) $color = $pen_color;
    imageline($img, $nx,$ny, $dx,$dy, $color);
  }
  $nx = $dx;
  $ny = $dy;
}
// 向きを変える
function turn($d, $absolute = FALSE) {
  global $angle;
  if ($absolute) {
    $angle = $d; return;
  }
  $angle = ($angle + $d) % 360;
  if ($angle < 0) $angle += 360;
}
// 初期化から描画まで一気に行う関数
function drawCanvas($w, $h, $file, $callbck) {
  $img = initCanvas($w, $h);
  $callbck($w, $h);
  imagepng($img, $file);
  echo "<img src='$file'>";
}
// ペンの色を変更する
function setPenColor($color) {
  global $pen_color;
  $pen_color = $color;
}
function forward_red($dist) {
  forward($dist, true, rgb(255,0,0));
}

