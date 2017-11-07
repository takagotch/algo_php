<?php
// データをランダムに作成
// ラベル0 = 左下
// ラベル1 = 右上
$data = [];
for ($i = 0; $i < 100; $i++) {
  // ラベル0のデータを生成
  $x = mt_rand(0, 30) / 100;
  $y = mt_rand(0, 30) / 100;
  $data[] = [0, $x, $y];
  // ラベル1のデータを生成
  $x = mt_rand(31, 100) / 100;
  $y = mt_rand(31, 100) / 100;
  $data[] = [1, $x, $y];
}
$json = json_encode($data);
file_put_contents('lr-data.json', $json);
echo $json."\n";
