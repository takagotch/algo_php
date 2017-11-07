<?php
// URLを読み込む
$url = "./test1.html";
$html = file_get_contents($url);
// HTMLをパースする
$dom = simplexml_load_string($html);
// 任意のパスを取り出す
$x = $dom->xpath('/html/body/div');
foreach ($x as $item) {
  // タグの属性を得る
  $attr = $item->attributes();
  $id = $attr["id"];
  // テキスト部分を得る
  $text = (string)$item;
  list($name,$price) = explode("=", $text);
  echo "$id,$name,$price\r\n";
}

