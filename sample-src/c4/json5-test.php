<?php
// JSON5のライブラリを取り込む
require 'json5.php';

// JSON5のデータファイルを読み込む
$json5 = file_get_contents("test.json5");

// JSON5のデータをPHPのデータ型に変換
$a = json5_decode($json5);
var_dump($a);

