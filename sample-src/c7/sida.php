<?php
require_once 'turtle.inc.php';

drawCanvas(600,700,"sida.png",
  function($w, $h) {
    f(20, 0, 0, $w, $h);
  });

function W1x($x, $y) { return 0.836 * $x + 0.044 * $y; };
function W1y($x, $y) { return -0.044 * $x + 0.836 * $y + 0.169; };
function W2x($x, $y) { return -0.141 * $x + 0.302 * $y; };
function W2y($x, $y) { return 0.302 * $x + 0.141 * $y + 0.127; };
function W3x($x, $y) { return 0.141 * $x - 0.302 * $y; };
function W3y($x, $y) { return 0.302 * $x + 0.141 * $y + 0.169; };
function W4x($x, $y) { return 0; };
function W4y($x, $y) { return 0.175337 * $y; };

function f($k, $x, $y, $w, $h) {
  global $img, $black;
  if ($k > 0) {
    f($k-1, W1x($x,$y), W1y($x,$y), $w,$h);
    if (rand(0,9) < 3) f($k-1, W2x($x,$y), W2y($x,$y), $w,$h); 
    if (rand(0,9) < 3) f($k-1, W3x($x,$y), W3y($x,$y), $w,$h); 
    if (rand(0,9) < 3) f($k-1, W4x($x,$y), W4y($x,$y), $w,$h); 
  }
  else {
    $s = 650;
    imagesetpixel($img, 
      $x * $s + $w * 0.5,
      $h - $y * $s,
      $black);
  }
}
