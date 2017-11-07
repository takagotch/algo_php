<?php
require_once 'turtle.inc.php';

$width  = 1000;
$height = 1000;
initCanvas($width, $height);

// 描画開始
$colors = [rgb(255,0,0), rgb(0,0,255)];
foreach(range(0, 9) as $i) {
  setPenColor($colors[$i%2]);
  turn(45 + $i * 10, TRUE);
  move($width/2, $height/2);
  uzu(100, 5, 7);
}

function uzu($i, $w, $step) {
  if ($i <= 0) return;
  forward($w);
  turn(90);
  uzu($i-1, $w + $step, $step);
}

// 画像出力
imagepng($img, "uzu2.png");
echo '<img src="uzu2.png">';

