<?php
// OpenCV の haarcascades ディレクトリの学習ファイル
$data_dir = "/usr/local/share/OpenCV/haarcascades";
$facedb = $data_dir."/haarcascade_frontalface_alt2.xml"; // 顔
$eyedb  = $data_dir."/haarcascade_eye.xml";              // 目
$mouthdb = $data_dir."/haarcascade_mcs_mouth.xml";       // 口

// 対象とする写真
$facefile = 'images/face2.jpg';

// 顔認識の結果を画像に書き込むための準備
$im    = imagecreatefromjpeg($facefile);
$red   = imagecolorallocate($im, 255, 0, 0);
$blue  = imagecolorallocate($im ,0, 0, 255);
$green = imagecolorallocate($im ,0, 255, 0);

// 顔を検出
$faces = face_detect($facefile, $facedb);
if (!$faces) { echo "no faces\n"; exit; }
$face = $faces[0];
foreach ($faces as $i => $f) {
  if (is_box_inside($face, $f)) $face = $f;
}
rect($im, $face, $red, "face");

// 目を検出
// - 目は顔の上側にあるはず
$eye_area = [
  "x"=>$face["x"], "y"=>$face["y"],
  "w"=>$face["w"], "h"=>$face["w"] / 2
];
$eyes = face_detect($facefile, $eyedb);
if (!$eyes) { echo "no eyes\n"; exit; }
foreach ($eyes as $i => $eye) {
  // 目があるべき位置になければ描画をスキップ
  if (!is_box_inside($eye_area, $eye)) continue;
  arc($im, $eye, $blue, "eye{$i}");
}

// 口を検出
// - 口は顔の下側にあるはず
$w2 = $face["w"] / 2;
$mouth_area =  [
  "x"=>$face["x"], "y"=>$face["y"] + $w2,
  "w"=>$face["w"], "h"=>$w2 
];
$mouth = face_detect($facefile, $mouthdb);
foreach ($mouth as $i => $m) {
  // 口があるべき位置になければ描画をスキップ
  if (!is_box_inside($mouth_area, $m)) continue;
  rect($im, $m, $green, "mouth{$i}");
}

// 画像を出力
imagejpeg($im, "face-out.jpg");
echo "<img src='face-out.jpg'>";

// 矩形を描画
function rect($im, $o, $color, $desc) {
  $x = $o["x"]; $y = $o["y"]; $w = $o["w"];
  $h = isset($o["h"]) ? $o["h"] : $o["w"];
  imagerectangle($im, $x, $y, $x + $w, $y + $h, $color);
  echo "($desc x:$x, y:$y, w:$w, h:$h)";
}
// 円を描画
function arc($im, $o, $color, $desc) {
  $x = $o["x"]; $y = $o["y"]; $w = $o["w"]; $w2 = $w / 2;
  $h = isset($o["h"]) ? $o["h"] : $o["w"];
  imagearc($im, $x+$w2, $y+$w2, $w, $h, 0, 360, $color);
  echo "($desc x:$x, y:$y, w:$w, h:$h)";
}
// 矩形$b は 矩形$a に内包されるか？
function is_box_inside($a, $b) {
  $ax1 = $a["x"];
  $ay1 = $a["y"];
  $ax2 = $ax1 + $a["w"];
  $ay2 = $ay1 + (isset($a["h"]) ? $a["h"] : $a["w"]);
  $bx1 = $b["x"];
  $by1 = $b["y"];
  $bx2 = $bx1 + $b["w"];
  $by2 = $by1 + (isset($b["h"]) ? $b["h"] : $b["w"]);
  return ($ax1 <= $bx1) && ($bx2 <= $ax2) &&
         ($ay1 <= $by1) && ($by2 <= $ay2);
}



