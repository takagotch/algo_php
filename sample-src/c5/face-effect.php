<?php
// OpenCV の haarcascades ディレクトリの学習ファイル
$data_dir = "/usr/local/share/OpenCV/haarcascades";
$facedb = $data_dir."/haarcascade_frontalface_alt_tree.xml";
// 対象とする写真
$facefile = 'images/chinatown2.jpg';

// 顔認識の結果を画像に書き込む
$im = imagecreatefromjpeg($facefile);
$marker = imagecolorallocate($im, 255, 255, 255);

// 顔を検出
$faces = face_detect($facefile, $facedb);
if (!$faces) { echo "no faces\n"; exit; }
foreach ($faces as $i => $f) {
  rect($im, $f, $marker, "face");
}

// 画像を出力
imagejpeg($im, "face-out.jpg");
echo "<img src='face-out.jpg'>";

// 矩形を描画
function rect($im, $o, $color, $desc) {
  $x = $o["x"]; $y = $o["y"]; $w = $o["w"];
  $h = isset($o["h"]) ? $o["h"] : $o["w"];
  filter($im, $x, $y, $w, $h);
  imagerectangle($im, $x, $y, $x + $w, $y + $h, $color);
  echo "($desc x:$x, y:$y, w:$w, h:$h)<br>";
}

// 任意の領域にフィルタをかける
function filter($im, $x, $y, $w, $h) {
  $tmp = imagecreatetruecolor($w, $h);
  imagecopy($tmp, $im, 0, 0, $x, $y, $w, $h);
  imagefilter($tmp, IMG_FILTER_PIXELATE, 6);
  imagecopy($im, $tmp, $x, $y, 0, 0, $w, $h);
  imagedestroy($tmp);
}

