<?php
// コッホ曲線を描画
require_once 'turtle.inc.php';

$w = 1000;
$h = 400;
initCanvas($w, $h);

move(10, $h-20);
koch(3, $w-20);

function koch($i, $w) {
  if ($i < 0) {
    forward($w); return;
  }
  $w3 = $w / 3;
  koch($i - 1, $w3);
  turn(-60);
  koch($i - 1, $w3);
  turn(120);
  koch($i - 1, $w3);
  turn(-60);
  koch($i - 1, $w - 2*$w3);
}

imagepng($img, "kochcurve.png");
echo '<img src="kochcurve.png">';

