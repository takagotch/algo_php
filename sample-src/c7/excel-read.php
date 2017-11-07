<?php
// ライブラリの取り込み
require_once 'vendor/phpoffice/phpexcel/Classes/PHPExcel.php';

// ファイルの読み込み
$excel = PHPExcel_IOFactory::load('test.xlsx');
$sheet = $excel->getActiveSheet();
$v = $sheet->getCell('A1')->getCalculatedValue();
echo "A1=$v\n";

