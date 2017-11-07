<?php
require_once 'vendor/davefx/phplot/phplot.php';

// サンプルデータの定義
$data = [
  ['9月',   4],['10月', 8], ['12月', 5],
  ['12月', 11],['1月',  8], ['2月',  7],
];

// PHPlotのオブジェクトを生成
$plot = new PHPlot(400,200);

// フォントのパスを指定
$plot->SetTTFPath(dirname(__FILE__).'/font');
$plot->SetDefaultTTFont('ipagp.ttf');

// 描画
$plot->SetDataValues($data);
$plot->DrawGraph();

