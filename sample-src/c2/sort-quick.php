<?php
// クイックソート
function quick_sort(&$arr) {
  if (count($arr) < 2) return $arr;
  $left = $right = array();
  // ピボットを選んで取り出す
  $pivot = array_shift($arr);
  // ピボットを基準に大小で左右に値を分ける
  foreach ($arr as $v) {
    if ($v < $pivot) {
      $left[] = $v;
    } else {
      $right[] = $v;
    }
  }
  // 左右を再帰的にソートして結合する
  quick_sort($left);
  quick_sort($right);
  $arr = array_merge($left, array($pivot), $right);
}

// 利用例
$arr = array(1,100,24,40,12,4);
quick_sort($arr);
echo implode(', ', $arr)."\n";

