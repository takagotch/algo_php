<?php
require_once 'vendor/davefx/phplot/phplot.php';

// サンプルデータの定義
$data = [
  ['2012年', 10, 42, 67],
  ['2013年', 12, 45, 62],
  ['2014年', 18, 52, 78],
  ['2015年', 12, 31, 56],
  ['2016年', 8 , 38, 70],
  ['2017年', 15, 40, 72],
];

// PHPlotのオブジェクトを生成
$plot = new PHPlot(400,200);
$plot->SetTTFPath(dirname(__FILE__).'/font');
$plot->SetDefaultTTFont('ipagp.ttf');

// データをセットして描画
$plot->SetDataValues($data);
$plot->DrawGraph();

