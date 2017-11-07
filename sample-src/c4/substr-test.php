<?php
$str = "abcdefg";
// 文字列の先頭が0であることに注意
echo substr($str, 0, 3)."\n"; // abc
echo substr($str, 1, 3)."\n"; // bcd
// $lengthを省略すると文字列の最後までを抽出
echo substr($str, 4)."\n";    // efg
echo substr($str, 6)."\n";    // g
// $startに負の値を指定
echo substr($str, -1, 1)."\n";// g
echo substr($str, -2)."\n";   // fg

