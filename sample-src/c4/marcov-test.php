<?php
// --- マルコフ連鎖で文章の要約 ---
require 'marcov.inc.php'; 

// テキストファイルを読む
$text = file_get_contents("wagahaiwa_nekodearu.txt");
$text = mb_convert_encoding($text, "utf-8", "Shift_JIS");
//　 テキスト中の《かな》を削除
$text = preg_replace('/《.+?》/', '', $text);

// マルコフ連鎖で作文
$mcv = marcov_gen($text, 3);
echo $mcv."\n";

