<?php
// データを宣言
$data = [
  'Taro'=>['age'=>30, 'hobby'=>['Guitar','Piano']],
  'Takeshi'=>['age'=>18, 'hobby'=>['Reading']],
  'Arisa'=>['age'=>16, 'hobby'=>['Walking','Tea']],
  'Sara'=>['age'=>22, 'hobby'=>['Sleeping']]
];
// 保存するファイルパス
$file = "serialize-test.xml";

// PHPの配列をXMLに変換する関数
function array2xml($arr, $xml_obj = NULL) {
  if ($xml_obj == NULL) {
    $def = '<?xml version="1.0"?><root></root>';
    $xml_obj = new SimpleXMLElement($def);
  }
  foreach($arr as $key => $value) {
    if (is_numeric($key)) $key = "item";
    if (is_array($value)) {
      $subnode = $xml_obj->addChild($key);
      array2xml($value, $subnode);
    } else {
      $v = htmlentities($value);
      $xml_obj->addChild($key, $v);
    }
  }
  return $xml_obj;
}

// 配列データをオブジェクトに変換
$xml_obj = array2xml($data);
$str = $xml_obj->asXML();
// ファイルに保存
file_put_contents($file, $str);

// ファイルから読み込む
$xml2 = simplexml_load_file($file);
foreach ($xml2->children() as $it) {
  $name = $it->getName();
  $age = $it->age;
  echo "$name:$age:";
  $hobby = $it->hobby;
  foreach ($hobby->children() as $h) {
    echo "($h)";
  }
  echo "\n";
}

