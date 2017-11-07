<?php
// ライブラリの取り込み
require_once 'vendor/phpoffice/phpexcel/Classes/PHPExcel.php';

// Excelのオブジェクトを生成
$excel = new PHPExcel();
$excel->setActiveSheetIndex(0); // 先頭のシートを選択
$sheet = $excel->getActiveSheet();
$sheet->setCellValue('A1', '3000');
$sheet->setCellValue('A2', '50');
$sheet->setCellValue('A3', '=12+15');
$sheet->setCellValue('A4', '=INT(A1*0.08)');
$sheet->setCellValue('A5', '=SUM(A1:A4)');

// 計算結果を表示
for ($row = 0; $row < 5; $row++) {
  $cell = $sheet->getCellByColumnAndRow(0, $row);
  $formula = $cell->getValue();
  $value   = $cell->getCalculatedValue();
  echo "row[$row] = $value ($formula)\n";
}


