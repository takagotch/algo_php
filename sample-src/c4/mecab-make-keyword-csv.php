<?php
$infile = "wagahai-list.txt";
$outfile = "wagahai-list.csv";
// 入力ファイルを得る
$txt = file_get_contents($infile);
// 分割する
$clist = preg_split('/\,\s*/', $txt);
// コストを追加
$keywords = array_map(function($v) {
  $v = trim($v);
  $cost = max(-36000, -400 * mb_strlen($v));
  return "$v,0,0,$cost,名詞,固有名詞,人名,名,*,*,*";
}, $clist);
// CSV(utf-8)で出力
$csv = implode("\n", $keywords);
file_put_contents($outfile, $csv);
echo $csv."\n";


