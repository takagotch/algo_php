<?php
$str = <<< EOS
雨が降ってきたのでレインコートを着ました。
アイスを買っていたので食べました。
EOS;
// カタカナを抽出
$pat = '#[\\x{30A1}-\\x{30FF}]+#u';
$cnt = preg_match_all($pat, $str, $m);
// 結果を出力
for ($i = 0; $i < $cnt; $i++) {
  $w = $m[0][$i];
  echo "- $w\n";
}

