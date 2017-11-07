<?php
$a = [ 1, 11, 111, 1111 ];

$res = array_map(function($v) {
  return ($v * 2);
}, $a);

print_r($res);

