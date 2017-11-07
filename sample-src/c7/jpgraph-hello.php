<?php
require_once 'vendor/jpgraph/src/jpgraph.php';
require_once 'vendor/jpgraph/src/jpgraph_line.php';

// サンプルデータ
$data = [10, 8, 4, 9, 15, 8, 5];

// Graphのオブジェクトを作成
$graph = new Graph(400, 200, "auto");
$graph->SetScale('textlin');

// グラフの種類を指定
$lineplot = new LinePlot($data);
$graph->Add($lineplot);
$graph->Stroke();

