<?php

test("Native(sort)", "sort");
test("bubble_sort", "bubble_sort");
test("comb_sort", "comb_sort");
test("merge_sort", "merge_sort");
test("quick_sort", "quick_sort");


// ベンチ用関数
function bench($name, $callback) {
  $tm = microtime(true);
  $callback();
  $v = microtime(true) - $tm;
  echo "|".$name." | ".number_format(ceil($v * 1000))." ms\n";
}

function make_random_a($count) {
  $a = [];
  for ($i = 0; $i < $count; $i++) {
    $a[] = rand(0,1000);
  }
  return $a;
}

function test($name, $callback) {
  bench("$name", function() use ($callback) {
    for ($i = 0; $i < 1000; $i++) {
      $a = make_random_a(1000);
      $callback($a);
    }
  });
}

function bubble_sort(&$arr) {
  $size = count($arr);
  for ($i = 0; $i < $size; $i++) {
    for ($j = 0; $j < ($size - 1 - $i); $j++) {
      if ($arr[$j + 1] < $arr[$j]) {
        $tmp = $arr[$j + 1]; // swap
        $arr[$j + 1] = $arr[$j];
        $arr[$j] = $tmp;
      }
    }
  }
}

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
        $swap = true;
      }
      $i++;
    }
  }
}

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





