<?php
require_once 'vendor/jpgraph/src/jpgraph.php';
require_once 'vendor/jpgraph/src/jpgraph_bar.php';
require_once 'vendor/jpgraph/src/jpgraph_line.php';

// サンプルデータ
$data1 = [10, 8, 4, 9,15, 8, 5];
$data2 = [15,10,11, 8, 9, 9, 8];

// Graphのオブジェクトを作成
$graph = new Graph(400, 200, "auto");
$graph->SetScale('textlin');

// 棒グラフを生成
$barplot = new BarPlot($data1);
// 折れ線グラフを生成
$lineplot = new LinePlot($data2);

// 台紙にそれぞれのグラフを追加
$graph->Add($barplot);
$graph->Add($lineplot);
$graph->Stroke();

