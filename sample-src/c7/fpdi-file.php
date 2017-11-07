<?php
require_once 'vendor/tecnickcom/tcpdf/tcpdf.php';
require_once 'vendor/setasign/fpdi/fpdi.php';

// PDFの用紙を設定
$pdf = new FPDI('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetXY(20, 30);
$pdf->Write(0, 'Hello, World!');

// ファイルに出力
$filepath = dirname(__FILE__)."/test.pdf";
$pdf->Output($filepath, 'F');

