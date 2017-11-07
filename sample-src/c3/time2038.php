<?php
// 64bit環境では以下も動く
// $tm = strtotime("2038-01-19 04:14:05");
// echo "$tm\n";
$t1 = 2147454845;
$t2 = $t1 + 5;
for ($i = $t1; $i < $t2; $i++) {
  echo date("Y-m-d H:i:s", $i) . "\n";
}

