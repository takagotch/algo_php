<?php
require_once 'turtle.inc.php';

drawCanvas(1000, 1000, "mand.png",
  function($w, $h) {
    $range_x = 2.0;
    $range_y = 2.0;
    $mx = -1.5;
    $my = -1.0;
    $step_x = $range_x / $w;
    $step_y = $range_y / $h;
    $max_n = 300;
    mand($w,$h, $mx,$my, $step_x,$step_y, $max_n);
  });

function mand($w,$h, $mx,$my, $step_x,$step_y, $max_n) {
  global $img;
  $clist = [
    rgb(205,  0,  0), rgb(205,205,  0), 
    rgb(  0,  0,155), rgb(0,  105,205),
    rgb(100,100,205), rgb(255,100,100),
    rgb(100,150,205), rgb( 56,205,150)
  ];
  $white = rgb(255, 255, 255);
  for ($i = 0; $i < $h; $i++) {
    for ($j = 0; $j < $w; $j++) {
      $pr = $mx + $step_x * $j;
      $pi = $my + $step_y * $i;
      $vr = 0; 
      $vi = 0;
      $n = 0;
      for(;;) {
        $tr = ($vr * $vr) - ($vi * $vi) + $pr;
        $ti = ($vr * $vi * 2) + $pi;
        $vr = $tr;
        $vi = $ti;
        $we = ($vr * $vr) + ($vi * $vi);
        if ($we > 4 || $n >= $max_n) break;
        $n++;
      }
      // 色を設定
      $color = $clist[$n % 8];
      if ($n == $max_n) $color = $white;
      imagesetpixel($img, $j, $i, $color);
    }
  }
}

