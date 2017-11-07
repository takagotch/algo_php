<?php

$s = "今日は,雨です。";
$res = mecab_exec($s);
echo $res."\n";

// MeCabを実行
function mecab_exec($str) {
  // コマンドライン版のMeCabのパスを指定
  $mecab_cmd = 'mecab';
  
  // 作業用の一時ファイルを決定
  $tmp_dir = sys_get_temp_dir();
  $file_in = tempnam($tmp_dir, 'mecab-in-');
  $file_out = tempnam($tmp_dir, 'mecab-out-');
  $opt = "-b ".(1024 * 64);
  
  // 入力ファイルを設定
  file_put_contents($file_in, $str."\n");
  
  // コマンドを実行
  $cmd = "\"$mecab_cmd\" $opt \"$file_in\" -o \"$file_out\"";
  $res = exec($cmd);
  // 結果を読み込む
  $out = file_get_contents($file_out);

  // 一時ファイルを削除
  unlink($file_in);
  unlink($file_out);

  return $out;
}

