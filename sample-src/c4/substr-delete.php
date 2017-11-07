<?php
$str = "abcdefghij";
echo str_delete($str, 3, 6)."\n"; // abcj
echo str_delete($str, 4, 6)."\n"; // abcd
echo str_delete($str, 0, 5)."\n"; // fghij

// 文字列$strの$startから$lengthを削除する
function str_delete($str, $start, $length) {
  // 前半部分
  $head = substr($str, 0, $start);
  // 後半部分
  $i = $start + $length;
  $foot = substr($str, $i);
  // 前半と後半をつなげて返す
  return $head.$foot; 
}

