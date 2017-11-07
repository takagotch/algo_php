<?php
require_once 'vendor/davefx/phplot/phplot.php';

// サンプルデータの定義
$data = [
  ['ビール', 30],
  ['ワイン', 20],
  ['日本酒', 15],
  ['焼酎',    8],
  ['マッコリ',4],
];
// 凡例はラベルの一次元配列なのでデータから生成する
$legend = [];
foreach ($data as $d) {
  $legend[] = $d[0];
}

// PHPlotのオブジェクトを生成
$plot = new PHPlot(400,400);
$plot->SetTTFPath(dirname(__FILE__).'/font');
$plot->SetDefaultTTFont('ipagp.ttf');

// グラフの種類を指定
$plot->SetPlotType('pie');
$plot->SetDataType('text-data-single');
$plot->SetShading(0); // 影をつけない
$plot->SetImageBorderType('plain'); // グラフを枠で囲む

// データを指定して描画
$plot->SetDataValues($data);
$plot->SetLegend($legend);
$plot->DrawGraph();

