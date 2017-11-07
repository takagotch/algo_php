<?php
require_once 'vendor/davefx/phplot/phplot.php';

// サンプルデータの定義
$data = [
  ['9',   4],['10', 8], ['12', 5],
  ['12', 11],['1',  8], ['2',  7],
];

// PHPlotのオブジェクトを生成
$plot = new PHPlot(400,200);
// データをセット
$plot->SetDataValues($data);

// 描画してファイルへ保存
$plot->SetFileFormat('png');
$plot->SetIsInline(TRUE);
$plot->SetOutputFile(dirname(__FILE__).'/test.png');
$plot->DrawGraph();

