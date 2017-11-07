<?php
// 適当なファイルをロックする
$lockfile = "./my.lock";
$fp = fopen($lockfile, 'w');

// ロックできるかどうか調べる
if (!flock($fp, LOCK_EX | LOCK_NB)) {
  echo "既に起動しています。\n";
  exit;
}

// 処理をここに記述
echo "処理開始\n";
for ($i = 1; $i <= 5; $i++) {
  sleep(1);
  echo ".\n";
}
echo "処理終了\n";

// ロック解除
flock($fp, LOCK_UN);
fclose($fp);

