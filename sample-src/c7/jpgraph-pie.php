<?php
require_once 'vendor/jpgraph/src/jpgraph.php';
require_once 'vendor/jpgraph/src/jpgraph_pie.php';

// サンプルデータ(各月ごとの経費)
$labels = ['9月', '10月', '11月', '12月', '01月', '02月'];
$values = [3000,  2400,   1234,   3400,   2400,   2000];

// Graphオブジェクトを生成
$graph = new PieGraph(400, 400);
$graph->legend->SetFont(FF_PGOTHIC);

// 円グラフのオブジェクトを生成
$pieplot = new PiePlot($values);
$pieplot->SetLegends($labels);

// 台紙となるPieGraphに追加
$graph->Add($pieplot);
$graph->Stroke();
