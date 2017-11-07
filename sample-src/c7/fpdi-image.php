<?php
require_once 'vendor/tecnickcom/tcpdf/tcpdf.php';
require_once 'vendor/setasign/fpdi/fpdi.php';

// PDFの用紙を設定
$pdf = new FPDI('P', 'mm', 'A4');
$pdf->AddPage();

// 画像を描画
$r = 170 / 400;
$w = 400 * $r;
$h = 225 * $r;
$x = 20; $y = 50;
$pdf->Image('image/take.jpg', $x, $y, $w, $h, 'JPG');

// フォントの設定
$pdf->SetFont('Helvetica', '', 32);
$pdf->SetTextColor(0, 200, 0);
$pdf->SetXY(20, 30);
$pdf->Write(0, 'I like bamboo!');

// 画面に出力
$pdf->Output();

