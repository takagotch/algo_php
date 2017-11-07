<?php
// 配列を初期化
$a = [ 1, 2, 3 ];

// --- 追加 ---
// 配列の末尾に値を追加(1)
$a[] = 4;
// 配列の末尾に値を追加(2)
array_push($a, 5);
// 配列の先頭に値を追加
array_unshift($a, 0);
print_r($a);

// --- 削除 ---
// 配列の先頭の値を削除
$v1 = array_shift($a);
echo $v1 . "\n";
// 配列の最後の値を削除
$v2 = array_pop($a);
echo $v2 . "\n";
print_r($a);



