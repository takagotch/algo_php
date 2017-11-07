<?php
// XMLを定義
$xml_str = <<<XML
<?xml version='1.0'?>
<items>
  <item id="101">
    <name>石けん</name>
    <price>510</price>
  </item>
  <item id="102">
    <name>ブラシ</name>
    <price>330</price>
  </item>
</items>
XML;

// XMLを解析
$xml = simplexml_load_string($xml_str);
// 各itemの情報を表示
foreach ($xml->item as $it) {
  $attr = $it->attributes();
  echo "(id:".$attr["id"].") ";
  echo $it->name." - ".$it->price."円\n";
}



