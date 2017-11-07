<?php
require_once 'turtle.inc.php';

drawCanvas(1100, 1100, "gasket.png",
  function ($w, $h) {
    move(40, $h-50);
    tri(9);
  });

function tri($i) {
  if ($i < 0) return;
  $len = pow(2, $i);
  foreach(range(0, 2) as $j) {
    forward($len);
    tri($i-1);
    forward($len);
    turn(-120);
  }
}

