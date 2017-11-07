<?php
// *** 注意 *** うまく動かないプログラム例です
// ダウンロード
$url = "http://oto.chu.jp/mmlbbs6/index.php?action=fav_memory";
$html = file_get_contents($url);
// SimpleXMLでパースする
$xe = simplexml_load_string($html);
var_dump($xe);

