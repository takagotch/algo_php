<?php
//
// 分割したファイルを結合する
//
define("HASH_ALGO", "sha256");
if (count($argv) <= 1) {
  die("usage: php cat.php (name.json)\n");
}
// 情報ファイルを得る
$infofile = $argv[1];
$info = json_decode(file_get_contents($infofile), TRUE);
$orgfile = $info['original_file'];
$orghash = $info['original_hash'];
// 出力ファイル名を決める
$outfile = $orgfile;
while (file_exists($outfile)) {
  $outfile = preg_replace('/^(.+)\.(.+?)$/', 
    '$1_2.$2', $outfile);
}
// ハッシュを確認しつつ結合
$fp = fopen($outfile, "w");
$files = $info["files"];
foreach ($files as $f) {
  $hash = $f["hash"];
  $name = $f["name"];
  $hash2 = hash_file(HASH_ALGO, $name);
  if ($hash != $hash2) {
    die("[エラー] ファイルの破損があります。".
        "`$name`\n$hash != $hash2\n");
  }
  fwrite($fp, file_get_contents($name));
  echo "結合: $name : $hash2\n";
}
fclose($fp);
$outhash = hash_file(HASH_ALGO, $outfile);
if ($outhash == $orghash) {
  echo "無事に結合しました : $outhash\n$outfile\n";
} else {
  unlink($outfile);
  echo "結合に失敗しました。\n$outhash != $orghash\n";
}

