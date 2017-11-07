<?php
require_once 'vendor/jpgraph/src/jpgraph.php';
require_once 'vendor/jpgraph/src/jpgraph_bar.php';

// サンプルデータ(各月ごとの経費)
$labels = ['9月', '10月', '11月', '12月', '01月', '02月'];
$values = [3000,  2400,   1234,   3400,   2400,   2000];

// Graphオブジェクトを生成
$graph = new Graph(400, 200, "auto");
$graph->SetScale('textlin');

// 棒グラフを生成
$barplot = new BarPlot($values);
$graph->Add($barplot);

// ラベルを追加
$graph->xaxis->SetFont(FF_PGOTHIC); // ipagp.ttf
$graph->xaxis->SetTickLabels($labels);

$graph->Stroke();

