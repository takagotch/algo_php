<?php
$a = [1,2,3,4,5,10,11,12];

// 無名関数を変数に代入
$callback = function ($v) {
  return ($v % 2 == 1);
};

// 呼び出し
$result = array_filter($a, $callback);
print_r($result);



