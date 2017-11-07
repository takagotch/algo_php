<?php
// C曲線を描画
require_once 'turtle.inc.php';

drawCanvas(1000,1000, "c-curve.png",
  function ($w, $h) {
    turn(-90);
    move($w/2, $h/3.5);
    ccurve(12, 7);
  });

function ccurve($i, $w) {
  if ($i <= 0) {
    forward($w); return;
  }
  ccurve($i-1, $w);
  turn(-90);
  ccurve($i-1, $w);
  turn(90);
}

