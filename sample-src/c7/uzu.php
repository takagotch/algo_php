<?php
require_once 'turtle.inc.php';

$width  = 1000;
$height = 1000;
initCanvas($width, $height);

// 描画開始
turn(45);
move($width/2,$height/2);
uzu(100, 10);

// 再帰的に描画
function uzu($i, $w) {
  if ($i <= 0) return;
  forward($w);
  turn(90);
  uzu($i-1, $w+6);
}

// 画像出力
imagepng($img, "uzu.png");
echo '<img src="uzu.png">';

