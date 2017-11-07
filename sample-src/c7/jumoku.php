<?php
// 樹木曲線を描画
require_once 'turtle.inc.php';

drawCanvas(1000, 1000, "jumoku.png",
  function ($w, $h) {
    move($w/2, $h-30);
    turn(270);
    forward(50);
    tree(10, 0.7, 260);
  });

function tree($i, $scale, $w) {
  if ($i < 0) return;
  forward($w);
  turn(-30);
  tree($i-1, $scale, $w * $scale);
  turn(60);
  tree($i-1, $scale, $w * $scale);
  turn(-30);
  forward(-1 * $w, FALSE);
}

