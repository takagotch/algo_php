<?php
// 樹木曲線に花を描画
require_once 'turtle.inc.php';

drawCanvas(1000, 1000, "jumoku2.png",
  function($w, $h) {
    global $green;
    $green = rgb(10,80,0);
    setPenColor($green);
    move($w/2, $h-10);
    turn(-90);
    forward(160);
    tree(8, 0.8, 160);
  });

function tree($i, $scale, $w) {
  if ($i <= 0) return;
  forward($w);
  if ($i < 3 && rand(0,9) < 5) flower(6, $w/3);
  turn(-35);
  tree($i-1, $scale, $w * $scale);
  turn(70);
  tree($i-1, $scale, $w * $scale);
  turn(-35);
  forward(-1 * $w, FALSE);
}

function flower($i, $w) {
  global $green;
  if ($i <= 0) return;
  setPenColor(rgb(255,80,0));
  forward($w);
  forward(-$w, FALSE);
  setPenColor($green);
  turn(60);
  flower($i-1, $w);
}

