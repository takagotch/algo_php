<?php
// YAMLライブラリの取り込み
require 'vendor/autoload.php';
use Symfony\Component\Yaml;

// データを宣言
$data = [
  'Taro'=>['age'=>30, 'hobby'=>['Guitar','Piano']],
  'Takeshi'=>['age'=>18, 'hobby'=>['Reading']],
  'Arisa'=>['age'=>16, 'hobby'=>['Walking','Tea']],
  'Sara'=>['age'=>22, 'hobby'=>['Sleeping']]
];
// 保存するファイルパス
$file = "serialize-test.yaml";

// PHP配列をYAMLに変換
$dumper = new Yaml\Dumper();
$yaml = $dumper->dump($data);
file_put_contents($file, $yaml);

// YAMLをファイルから読み込む
$yaml2 = file_get_contents($file);
$yaml_p = new Yaml\Parser();
$data2 = $yaml_p->parse($yaml2);
// 結果を表示
foreach ($data2 as $name => $v) {
  $age = $v["age"];
  $hobby = $v["hobby"][0];
  if (isset($v["hobby"][1])) {
    $hobby .= " ".$v["hobby"][1];
  }
  echo "[$name] $age $hobby\n";
}


