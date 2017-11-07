<?php
require_once 'vendor/davefx/phplot/phplot.php';

// サンプルデータの定義
$data = [
  ['09', 4], ['10', 8], ['12', 5],
  ['12', 11],['01', 8], ['02', 7],
];

// PHPlotのオブジェクトを生成
$plot = new PHPlot(400,200);
// データをセット
$plot->SetDataValues($data);
// 描画
$plot->DrawGraph();

