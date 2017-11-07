<?php
require 'mecab.inc.php';

// ファイルを読み込む
$txt = file_get_contents("wagahaiwa_nekodearu.txt");
$txt = mb_convert_encoding($txt, "utf-8", "sjis");

// MeCabでパースする
$mecab_res = mecab_parse($txt);

print_r($mecab_res);

