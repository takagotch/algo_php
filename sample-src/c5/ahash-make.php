<?php
include_once 'ahash-common.inc.php';
// 引数を調べる
if (count($argv) <= 1) {
  echo "no input"; exit;
}

// ファイルを与えたとき
if (is_file($argv[1])) {
  makeAHash($argv[1]); exit;
}
// ディレクトリを与えたとき
if (is_dir($argv[1])) {
  $files = enumJpeg($argv[1]);
  foreach ($files as $f) {
    echo "[make] $f\n";
    makeAHash($f);
  }
}


