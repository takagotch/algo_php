<?php
require_once 'vendor/tecnickcom/tcpdf/tcpdf.php';
require_once 'vendor/setasign/fpdi/fpdi.php';

// PDFの用紙を設定
$pdf = new FPDI('P', 'mm', 'A4');
$pdf->AddPage();

// フォントの設定
$pdf->SetFont('Helvetica', '', 32);
$pdf->SetTextColor(255, 0, 0);
$pdf->SetXY(20, 30);
$pdf->Write(0, 'Hello, World!');

// 画面に出力
$pdf->Output();

