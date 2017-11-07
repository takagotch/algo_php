<?php
// 樹木曲線+花を描画
require_once 'turtle.inc.php';

drawCanvas(1000, 1000, "jumoku2.png",
  function($w, $h) {
    move($w/2, $h-30);
    turn(270);
    forward(50);
    tree(8, 0.8, 180);
  });

function tree($i, $scale, $w) {
  if ($i <= 0) return;
  if ($i < 3) flower(8, $w/2);
  forward($w);
  turn(-30);
  tree($i-1, $scale, $w * $scale);
  turn(60);
  tree($i-1, $scale, $w * $scale);
  turn(-30);
  forward(-1 * $w, FALSE);
}

function flower($i, $w) {
  if ($i <= 0) return;
  forward($w); forward(-$w, FALSE);
  turn(45);
  flower($i-1, $w);
}

