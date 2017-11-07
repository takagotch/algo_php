<?php
// HTMLをダウンロード
$url = "./test1.html";
$html = file_get_contents($url);
// 任意の部分を正規表現で取り出す
$cnt = preg_match_all('#<div id="(.+?)">(.+?)\=(.+?)</div>#', $html, $res);
for ($i = 0; $i < $cnt; $i++) {
  $id = $res[1][$i];
  $name = trim($res[2][$i]);
  $price = trim($res[3][$i]);
  echo "$id,$name,$price\r\n";
}


