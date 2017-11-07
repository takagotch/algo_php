<?php
// ライブラリの取り込み
require_once 'vendor/phpoffice/phpexcel/Classes/PHPExcel.php';

// Excelのオブジェクトを生成
$excel = new PHPExcel();
$sheet = $excel->getActiveSheet();

// 複数の値を一気に設定
$values = [
  [NULL, '2015年度', '2016年度'],
  ['国語',       88,         60],
  ['数学',       40,         50],
  ['英語',       70,         75],
];
$sheet->fromArray($values, NULL, 'C2'); // C2を先頭に設定

// 複数の値を一気に取得
$data = $sheet->rangeToArray(
  "C2:E5", NULL,
  TRUE, // 計算済みの値を得るか
  TRUE, // フォーマット済みの値を得るか
  TRUE  // 配列の設定の仕方（TRUEなら行列、FALSEなら列行）
);
print_r($data);

// 書き込み用のオブジェクトを得る
$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$writer->save('test-array.xlsx');
echo "ok.\n";

