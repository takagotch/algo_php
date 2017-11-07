<?php
// ライブラリの取り込み
require_once 'vendor/phpoffice/phpexcel/Classes/PHPExcel.php';

// Excelのオブジェクトを生成
$excel = new PHPExcel();
$sheet = $excel->getActiveSheet();
$sheet->setCellValue('A1', 'Hello, World!');

// 書き込み用のオブジェクトを得る
$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$writer->save('test.xlsx');
echo "ok.\n";

