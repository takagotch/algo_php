<?php
$str = "2018-10-30";

// 文字列の置換
echo str_replace("-", "/", $str)."\n"; // 2018/10/30

// 分割して結合すると置換したのと同じになる
echo implode("/", explode("-", $str)); // 2018/10/30


