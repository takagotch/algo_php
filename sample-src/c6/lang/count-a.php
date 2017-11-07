<?php
// 言語ごとの出力パターン
$lang_out = [
  "en" => "1 0 0",
  "tl" => "0 1 0",
  "id" => "0 0 1",
];

make_fann_data("train");
make_fann_data("test");
echo "ok.\n";

function make_fann_data($dir) {
  global $lang_out;
  $total_ch = 0;
  // ファイル一覧を得る
  $files = glob("./$dir/*.txt");
  $samples = 0;
  $data = "";
  foreach ($files as $fname) {
    echo "get: $fname\n";
    $lang = substr(basename($fname), 0, 2);
    $txt = file_get_contents($fname);
    $cnt = count_text($txt);
    $total = array_sum($cnt);
    $res = array_map(function($n)use($total) {
      return $n / $total;
    }, $cnt);
    $total_ch += $total;
    $data .= implode(" ", $res)."\n";
    $data .= $lang_out[$lang]."\n";
    $samples++;
  }
  // FANNの形式で保存
  file_put_contents("lang-$dir.dat", 
    "$samples 26 3\n".$data);
  echo "total_ch = $total_ch\n";
}

function count_text($text) {
  $text = strtolower($text);
  $text = str_replace(" ", '', $text);
  $cnt = array_fill(0, 26, 0);
  for ($i = 0; $i < strlen($text); $i++) {
    $c = ord(substr($text, $i, 1));
    if (97 <= $c && $c <= 122) {
      $c -= 97;
      $cnt[$c]++;
    }
  }
  return $cnt;
}



