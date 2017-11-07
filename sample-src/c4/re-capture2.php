<?php
// 対象文字列
$css = <<< EOS
.hoge {
  color: #FFCC99;
  background-color: #3322FF;
}
EOS;
// HTMLのカラーコードを取り出す
$pat = '/\#([0-9A-F]{2})([0-9A-F]{2})([0-9A-F]{2})/';
// 正規表現マッチして赤緑青の成分を抽出する
$css = strtoupper($css); // 大文字変換
$match_cnt = preg_match_all($pat, $css, $m);
for ($i = 0; $i < $match_cnt; $i++) {
  echo "[0] 全体  = ".$m[0][$i]."\n";
  echo "[1] RED   = 0x".$m[1][$i]."\n";
  echo "[2] GREEN = 0x".$m[2][$i]."\n";
  echo "[3] BLUE  = 0x".$m[3][$i]."\n";
  echo "---\n";
}

