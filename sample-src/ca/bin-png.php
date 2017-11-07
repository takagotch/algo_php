<?php
// PNGをバイナリ解析
// ファイルを開く --- (*1)
$fp = fopen('test.png', 'r');

// シグネチャの確認 ---- (*2)
$png_sig = "\x89PNG\r\n\x1a\n";
$sig = fread($fp, 8);
if ($sig !== $png_sig) {
  die("PNGファイルではない");
}

// 複数のチャンクを順に読む --- (*3)
while (!feof($fp)) {
  $chunk = readChunk($fp);
  echo "[".$chunk["type"]."]\n";
  // チャンクの種類で分岐
  if ($chunk['type'] == "IEND") break;
  if ($chunk['type'] == "IHDR") readIHDR($chunk);
}

// チャンクを読む --- (*4)
function readChunk($fp) {
  $chunk = [];
  // チャンク長さ(4byte)
  $chunk["len"]  = ord_be(fread($fp, 4));
  // チャンク種類(4byte)
  $chunk["type"] = fread($fp, 4);
  // 可変長のデータ
  if ($chunk["len"] > 0) {
    $chunk["data"] = fread($fp, $chunk["len"]);
  } else {
    $chunk["data"] = null;
  }
  // CRC (4byte)
  $chunk["crc"] = ord_be(fread($fp, 4));
  return $chunk;
}

// 画像ヘッダチャンクを解析 --- (*5)
function readIHDR($chunk) {
  $data = $chunk["data"];
  $width  = ord_be(substr($data, 0, 4));
  $height = ord_be(substr($data, 4, 4));
  $bit = ord(substr($data, 8, 1));
  $ctype = ord(substr($data, 9, 1));
  $comp = ord(substr($data,10, 1));
  $filter = ord(substr($data,11, 1));
  $ir = ord(substr($data,12, 1));
  echo "  | size = $width x $height\n";
  echo "  | bit  = $bit\n";
}

// ビッグエンディアンのバイナリを数値で返す --- (*6)
function ord_be($bin) {
  $value = 0;
  for ($i = 0; $i < strlen($bin); $i++) {
    $c = substr($bin, $i, 1);
    $v = ord($c);
    $value = ($value << 8) + $v;
  }
  return $value;
}

