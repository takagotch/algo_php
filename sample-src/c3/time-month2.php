<?php
$t = strtotime("2018-11-1");
$t = month_add_2($t, 3);
echo date('Y-m-d', $t)."\n";

function month_add_2($t, $n) {
  $year = date('Y', $t);
  $month = (int)date('m', $t);
  $day = (int)date('d', $t);
  $res = mktime(0,0,0,$month+$n, $day, $year); // --- (*1)
  return $res;
}


