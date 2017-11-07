<?php
// ハニカム構造を描画
require_once 'turtle.inc.php';

drawCanvas(1000, 1000, "honeycomb.png",
  function ($w, $h) {
    move($w/2, $h/2);
    honeycomb(7, 36);
  });

function honeycomb($i, $w) {
  if ($i <= 0) return;
  // 中央
  draw6($w);
  //左上 
  pmove($w, -60, 60);
  honeycomb($i-1, $w);
  // 右上
  pmove($w, 60, 60, 240);
  honeycomb($i-1, $w);
  // 右
  pmove($w, 180, -60, 240);
  honeycomb($i-1, $w);
  // 右下
  pmove($w, 180, 60, 120);
  honeycomb($i-1, $w);
  // 左下
  pmove($w, -60, -60, -240);
  honeycomb($i-1, $w);
  // 左
  pmove($w, -60, 60);
  honeycomb($i-1, $w);
  // 始点に戻る 
  pmove($w, 60, 60, 240); 
}

// 六角形を描画
function draw6($w) {
  foreach(range(1, 6) as $i) {
    turn(60);
    forward($w);
  }
}

// 位置移動
function pmove($w, $r1, $r2, $r3 = 0) {
  turn($r1); forward($w, FALSE);
  turn($r2); forward($w, FALSE);
  turn($r3);
}

