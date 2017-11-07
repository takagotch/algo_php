<?php
require_once 'vendor/tecnickcom/tcpdf/tcpdf.php';
require_once 'vendor/setasign/fpdi/fpdi.php';

// PDFの用紙を設定
$pdf = new FPDI('P', 'mm', 'A4');
$pdf->AddPage();

// 日本語フォントの設定 --- (*1)
$font_path = dirname(__FILE__).'/font/ipagp.ttf';
$font = TCPDF_FONTS::addTTFfont($font_path);
$pdf->SetFont($font, '', 32);
// 色と位置を指定して日本語を描画
$pdf->SetTextColor(30, 0, 90);
$pdf->SetXY(20, 30);
$pdf->Write(0, "こんにちは。");
$pdf->SetXY(20, 54);
$pdf->Write(0, "PDFを自動生成しています。");

// 画面に出力
$pdf->Output();

