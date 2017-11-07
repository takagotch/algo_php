<?php
require_once 'vendor/tecnickcom/tcpdf/tcpdf.php';
require_once 'vendor/setasign/fpdi/fpdi.php';

// PDFの用紙を設定
$pdf = new FPDI('P', 'mm', 'A4');
$pdf->AddPage();

// --- 紫の横線を引く --- (*1)
// 線のスタイルを指定
$pdf->SetLineStyle([
  "width" => 3,
  "dash" => 0,
  "color" => [255,0,255]
]);
// 罫線を描画
$pdf->Line(10,20,190,20);

// --- ドットで複数の線を描く --- (*2)
$pdf->SetLineStyle([
  "width" => 0.3,
  "dash" => 1,
]);
for ($i = 0; $i < 30; $i++) {
  $pdf->Line(10, 30,190,30+$i*2,["color"=>[255,0,0]]);
  $pdf->Line(10, 90,190,30+$i*2,["color"=>[0,0,255]]);
}

// --- いろいろな図形を描画 --- (*3)
$pdf->SetLineStyle([
  "width" => 1, "dash" => 0, "color" => [0,0,0]
]);
// 矩形を描画
$pdf->Rect(10,100,30,30);
// 連続線を描画
$pdf->PolyLine([50,100, 80,120, 110,100, 140,120]);
// 円を描画
$pdf->Ellipse(170, 115, 15, 15);

// 画面に出力
$pdf->Output();

