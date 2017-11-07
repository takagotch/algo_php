<?php
// ヒルベルト曲線を描画
require_once 'turtle.inc.php';

drawCanvas(1000,1000,"hilbert.png", 
  function() {
    move(30, 30);
    hilbert(5, 30, 90);
  });

function hilbert($i, $w, $angle) {
  if ($i <= 0) return;
  // 1
  turn($angle);
  hilbert($i-1, $w, -$angle);
  forward($w);
  // 2
  turn(-$angle);
  hilbert($i-1, $w, $angle);
  forward($w);
  // 3
  hilbert($i-1, $w, $angle);
  turn(-$angle);
  forward($w);
  // 4
  hilbert($i-1, $w, -$angle);
  turn($angle);
}

