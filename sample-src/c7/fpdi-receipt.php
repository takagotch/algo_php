<?php
require_once 'vendor/tecnickcom/tcpdf/tcpdf.php';
require_once 'vendor/setasign/fpdi/fpdi.php';

// 基本情報
$template_file = 'image/template.pdf';
$font_path = 'font/ipagp.ttf';
$data = [
  "name"  => "鈴木 一郎",
  "price" => "￥3,500-",
  "desc" => "お品代として",
  "y" => 2017, "m" => 12, "d" => 1
];

// PDFの作成
$pdf= new FPDI("P","mm","A4");
$pdf->SetMargins(0,0,0);

// テンプレートの複製 --- (*1)
$pdf->SetSourceFile($template_file);
$p1 = $pdf->importPage(1);
$pdf->AddPage();
$pdf->useTemplate($p1, null, null, null, null, true);

// フォントの設定
$font = TCPDF_FONTS::addTTFfont($font_path);
$pdf->SetFont($font, '', 28);
$pdf->SetTextColor(0, 0, 0);

// 名前を記入
$pdf->SetXY(80, 25);
$pdf->Write(0, $data["name"]);
// 金額を記入
$pdf->SetXY(80, 45);
$pdf->Write(0, $data["price"]);
// 日付を記入
$pdf->SetFont($font, '', 14);
$pdf->SetXY(38, 82);
$pdf->Write(0, $data["y"]);
$pdf->SetXY(64, 82);
$pdf->Write(0, $data["m"]);
$pdf->SetXY(86, 82);
$pdf->Write(0, $data["d"]);
// 但し書き
$pdf->SetXY(40, 67);
$pdf->Write(0, $data["desc"]);

// 画面に出力
$pdf->Output();

