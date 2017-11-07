<?php
//
// ファイルを分割する
//
define("HASH_ALGO", "sha256");

// 使い方
if (count($argv) <= 1) {
  die("usage: php split.php (infile) (size)\n");
}

// 入力をチェック
$infile = $argv[1];
$div_size = (isset($argv[2])) ? $argv[2] : 0;
if ($div_size == 0) $div_size = floor(filesize($infile) / 3);
// 3k や 3m など単位があった場合を考慮
if (preg_match('/^(\d+)(k|kb)$/i', $div_size, $m)) {
  $div_size = floatval($m[1]) * 1024;
}
if (preg_match('/^(\d+)(m|mb)$/i', $div_size, $m)) {
  $div_size = floatval($m[1]) * 1024 * 1024;
}
if (preg_match('/^(\d+)(g|gb)$/i', $div_size, $m)) {
  $div_size = floatval($m[1]) * 1024 * 1024 * 1024;
}

// サイズを計算
$fsize = filesize($infile);
$fcount = floor($fsize / $div_size);
if ($fsize % $div_size > 0) $fcount++;

// 入力ファイルのハッシュ値を計算
$infile_hash = hash_file(HASH_ALGO, $infile);
echo "infile_hash: $infile_hash\n";

// 保存ファイル名を自動的に決定
$base_name = preg_replace('/\./', '_', $infile);

// ファイルを分割保存
$files = [];
$in_fp = fopen($infile, "r");
for ($i = 0; $i < $fcount; $i++) {
  $outfile = $base_name.sprintf(".%03d", $i);
  $out_fp = fopen($outfile, "w");
  $tmp = fread($in_fp, $div_size);
  $hash = hash(HASH_ALGO, $tmp);
  fwrite($out_fp, $tmp);
  fclose($out_fp);
  $test_hash = hash_file(HASH_ALGO, $outfile);
  if ($test_hash != $hash) {
    die("ファイル保存に失敗:`$outfile`\n");
  }
  echo "- $outfile : $hash\n";
  $files[] = [
    "name" => basename($outfile), 
    "hash" => $hash
  ];
}

// 分割情報を保存
$info = [
  "original_file" => basename($infile),
  "original_hash" => $infile_hash,
  "base_name"     => $base_name,
  "count"         => $fcount,
  "date"          => date("Y-m-d H:i:s"),
  "files"         => $files
];
file_put_contents("cat-$base_name.json", json_encode($info));

// Windows用のバッチファイルも作成
$batfiles = [];
$outfile = basename($infile);
foreach ($files as $f) {
  $name = $f["name"];
  $batfiles[] = "\"$name\"";  
}
$bat = "copy /b ".implode("+", $batfiles);
$bat .= " \"$outfile\"\r\n";
file_put_contents("cat-$base_name.bat", $bat);

// Linux/OS X用のシェルスクリプトも作成
$sh = "#!/bin/sh\ncat ".implode(" ", $batfiles);
$sh .= " > \"$outfile\"\n";
file_put_contents("cat-$base_name.sh", $sh);
echo "ok.\n";


