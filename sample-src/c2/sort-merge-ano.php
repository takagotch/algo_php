<?php
// マージソート
function merge_sort_r(&$arr, $first, $last) {
  if ($first >= $last) return;
  // 分割
  $center = floor(($first + $last) / 2);
  $p = $j = 0;
  $k = $first;
  // ソート
  merge_sort_r($arr, $first, $center);    // 前半
  merge_sort_r($arr, $center + 1, $last); // 後半
  // ここから前半と後半を比較して一つにまとめる
  // 前半を待避
  $tmp = array();
  for ($i = $first; $i <= $center; $i++) {
    $tmp[$p++] = $arr[$i];
  }
  //
  while ($i <= $last && $j < $p) {
    if ($tmp[$j] <= $arr[$i]) {
      $arr[$k++] = $tmp[$j++];
    } else {
      $arr[$k++] = $arr[$i++];
    }
  }
  // 残りを追加
  while ($j < $p) {
    $arr[$k++] = $tmp[$j++];
  }
}
function merge_sort(&$arr) {
  merge_sort_r($arr, 0, count($arr) - 1);
}
// 利用例
$arr = array(1,100,24,40,12,4);
merge_sort($arr);
echo implode(', ', $arr)."\n";


