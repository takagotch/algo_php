<?php
// コムソート
function comb_sort(&$arr) {
  $gap = $size = count($arr);
  $swap = true;
  while ($gap > 1 || $swap) {
    if ($gap > 1) {
      $gap = floor($gap / 1.25);
      if ($gap == 9 || $gap == 10) $gap = 11;
    }
    $swap = false;
    $i = 0;
    while ($i + $gap < $size) {
      if ($arr[$i] > $arr[$i + $gap]) {
        $tmp = $arr[$i];
        $arr[$i] = $arr[$i + $gap];
        $arr[$i + $gap] = $tmp;
$j = $i + $gap;
$v1 = $arr[$i];
$v2 = $arr[$j];
echo "swap $i:$v1 <-> $j:$v2\n";
        $swap = true;
      }
      $i++;
    }
  }
}
// 利用例
$arr = array(9,3,4,1,5);
comb_sort($arr);
echo implode(", ", $arr)."\n";

