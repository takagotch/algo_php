<?php
$t = strtotime("2018-1-1");
$t = month_add($t, 3);
echo date('Y-m-d', $t)."\n";

function month_add($t, $n) {
  $year = date('Y', $t);
  $month = (int)date('m', $t);
  // 年を元に日数テーブルを作る
  $mm = [1=>31, 2=>28, 3=>31, 4=>30, 5=>31, 6=>30,
         7=>31, 8=>31, 9=>30, 10=>31, 11=>30, 12=>31];
  $isleap = ($year%4)==0 && ($year%100)!=0 || ($year%400)==0;
  $mm[2] = $isleap ? 29 : 28;
  // nヶ月後の日数計算
  $days = 0;
  for ($i = 0; $i < $n; $i++) {
    $m = $month + $i;
    $m = ($m > 12) ? $m - 12 : $m;
    $days += $mm[$m];
  }
  $DAY_SEC = 60 * 60 * 24;
  return $t + ($days * $DAY_SEC);
}


