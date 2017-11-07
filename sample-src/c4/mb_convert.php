<?php
// このプログラムは「UTF-8」で記述されているものとする
mb_internal_encoding("utf-8");
// 対象文字列
$utf8 = "今日は天気が良い。";
// 変換
$sjis = mb_convert_encoding($utf8, "SJIS");
// 文章をバイナリで出力
echo $utf8."\n";
echo "utf8: ".bin2hex($utf8)."\n";
echo "sjis: ".bin2hex($sjis)."\n";



