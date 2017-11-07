<?php
// MeCabをコマンドラインから実行するライブラリ
// 「mecab」コマンドのパスを指定する --- (*1)
define("MECAB_COMMAND", "mecab");

// MeCabを実行して結果を得る
function mecab_exec($input, $opt = false) {
  $mecab_cmd = MECAB_COMMAND;

  // 一時ファイルを決定 --- (*2)
  $tmp_dir = sys_get_temp_dir();
  $file_in = tempnam($tmp_dir, 'mecab-in-');
  $file_out = tempnam($tmp_dir, 'mecab-out-');
  if (!$opt) {
    $opt = "-b ".(1024 * 64);
  }

  // 入力ファイルを設定
  file_put_contents($file_in, $input."\n");
  // コマンドを実行 --- (*3)
  $cmd = "\"$mecab_cmd\" $opt \"$file_in\" -o \"$file_out\"";
  exec($cmd);
  $out = file_get_contents($file_out);
  // 一時ファイルを削除 --- (*4)
  unlink($file_in);
  unlink($file_out);

  return $out;
}

// 実行結果を配列で得る --- (*5)
function mecab_parse($input, $mecab_opt = false) {
  // MeCabを実行
  $out = mecab_exec($input, $mecab_opt);
  // 入力を配列に変換
  $lines = explode("\n", trim($out));
  $result = [];
  foreach ($lines as $line) {
    list($word,$params) = explode("\t", $line."\t");
    $list = explode(",", trim($params));
    array_unshift($list, $word);
    $result[] = $list;
  }
  return $result;
}

// 実行結果を配列で得る(単語のみ)
function mecab_parse_simple($input, $mecab_opt = false) {
  $out = mecab_exec($input, $mecab_opt);
  $lines = explode("\n", trim($out));
  $res = [];
  foreach ($lines as $line) {
    $res[] = trim(substr($line, 0, strpos($line, "\t")));
  }
  return $res;
}

