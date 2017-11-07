<?php
//
// PNGに暗号文を埋め込む
//

// 引数の確認
if (count($argv) <= 1) {
  echo "usage:\n";
  echo "[insert] png-insert.php (pngfile) (message)\n";
  echo "[read  ] png-insert.php (pngfile)\n";
  exit;
}

$pngfile = $argv[1];
$message = isset($argv[2]) ? $argv[2] : null;

// PNGファイルをメモリに読み込む --- (*1)
$fp = fopen($pngfile, 'r+');
checkSignature($fp);
$chunk_list = readChunkList($fp);

// 動作の変更
if ($message !== null) {
  insertMessage($fp, $chunk_list, $message);
} else {
  readMessage($chunk_list);
}
echo "ok.\n";

// メッセージを埋め込む --- (*2)
function insertMessage($fp, $chunk_list, $message) {
  // 埋め込むチャンクを生成
  $my_chunk = [
    "len"  => strlen($message),
    "type" => "txtt",
    "data" => $message,
    "crc"  => crc32($message)
  ];
  // 末尾に独自のチャンクを追加 --- (*3)
  $iend_chunk = array_pop($chunk_list); // 末尾IENDを取る
  array_push($chunk_list, $my_chunk);   // 独自を追加
  array_push($chunk_list, $iend_chunk); // IENDを追加
  
  // PNGファイルの書き換え --- (*4)
  fseek($fp, 8); // シグネチャの後に移動
  foreach ($chunk_list as $ch) {
    // チャンクを書き込む
    fwrite($fp, int2bin($ch["len"]));
    fwrite($fp, $ch["type"]);
    fwrite($fp, $ch["data"]);
    fwrite($fp, int2bin($ch["crc"]));
  }
}

// 埋め込んだメッセージを表示する --- (*4)
function readMessage($chunk_list) {
  foreach ($chunk_list as $ch) {
    if ($ch["type"] == "txtt") {
      $msg = $ch["data"];
      echo "message = $msg\n";
    }
  }
}

// PNGシグネチャをチェック
function checkSignature($fp) {
  $PNG_SIG = "\x89PNG\r\n\x1a\n";
  $sig = fread($fp, 8);
  if ($sig !== $PNG_SIG) die("PNGファイルではない");
}

// 複数のチャンクを読む
function readChunkList($fp) {
  $chunk_list = [];
  while (!feof($fp)) {
  $chunk = readChunk($fp);
    $chunk_list[] = $chunk;
    if ($chunk['type'] == "IEND") break;
  }
  return $chunk_list;
}
// 一つのチャンクを読む
function readChunk($fp) {
  $chunk = [];
  $chunk["len"]  = bin2int(fread($fp, 4));
  $chunk["type"] = fread($fp, 4);
  if ($chunk["len"] > 0) {
    $chunk["data"] = fread($fp, $chunk["len"]);
  } else {
    $chunk["data"] = null;
  }
  $chunk["crc"] = bin2int(fread($fp, 4));
  return $chunk;
}

// ビッグエンディアンのバイナリを数値に変換 --- (*5)
function bin2int($bin) {
  $a = unpack("N", $bin);
  return array_shift($a);
}
// 数値をバイナリに変換
function int2bin($v) {
  $bin = pack("N", $v);
  return $bin;
}

