<?php
// マージソート
function merge_sort(&$arr) {
  $arr = merge_sort_split($arr);
}
// 分割
function merge_sort_split($arr) {
  if (count($arr) == 1) return $arr;
  // とにかく半分に分割する
  $mid = floor(count($arr) / 2);
  $left  = array_slice($arr, 0, $mid);
  $right = array_slice($arr, $mid, count($arr));
  // 再帰的に分割する
  $left = merge_sort_split($left);
  $right = merge_sort_split($right);
  return merge_sort_merge($left, $right);  
}
// 結合
function merge_sort_merge($left, $right) {
  $result = array();
  // 左右を小さい順に追加
  while(count($left) && count($right)) {
    if ($left[0] < $right[0]) {
      $result[] = array_shift($left);
    } else {
      $result[] = array_shift($right);
    }
  }
  // 半端な残りの要素を追加
  return array_merge($result, $left, $right);
}
// 利用例
$arr = array(1,100,24,40,12,4);
merge_sort($arr);
echo implode(', ', $arr)."\n";


