<?php
// データを宣言
$data = [
  'Taro'=>['age'=>30, 'hobby'=>['Guitar','Piano']],
  'Takeshi'=>['age'=>18, 'hobby'=>['Reading']],
  'Arisa'=>['age'=>16, 'hobby'=>['Walking','Tea']],
  'Sara'=>['age'=>22, 'hobby'=>['Sleeping']]
];
// 保存するファイルパス
$file = "serialize-test.txt";

// シリアライズ
$str = serialize($data);
// ファイルに保存
file_put_contents($file, $str);

// ファイルからデータを復元
$str2 = file_get_contents($file);
$data2 = unserialize($str2);
// Arisaのhobbyを表示
print_r($data2['Arisa']['hobby']);


