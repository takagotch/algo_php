<?php
// 変数に値を代入
$fn = function ($num) {
  $num2 = $num * 2;
  echo "{$num}x2 = {$num2}\n";
};
// 変数に入れた関数を実行する
$fn(10); // 10x2 = 20
$fn(15); // 15x2 = 30

