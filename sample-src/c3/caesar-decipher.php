<?php
// 暗号文を読み込む
$s = trim(file_get_contents("angoubun.txt"));
// 一文字ずつずらして解読に挑戦
for ($i = 1; $i <= 25; $i++) {
  $dec = decode($s, $i);
  echo "[$i] $dec\n";
}

// シーザー暗号の変換テーブル生成
function makeTable($shift) {
  $alp_b = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $alp_s = "abcdefghijklmnopqrstuvwxyz";
  $shift = $shift % strlen($alp_b);
  $alp_b_shift = substr($alp_b, $shift).substr($alp_b, 0, $shift);
  $alp_s_shift = substr($alp_s, $shift).substr($alp_s, 0, $shift);
  $table = [];  
  for ($i = 0; $i < strlen($alp_b); $i++) {
    $c1 = substr($alp_b, $i, 1);
    $c2 = substr($alp_b_shift, $i, 1);
    $table[$c2] = $c1;
    $c1 = substr($alp_s, $i, 1);
    $c2 = substr($alp_s_shift, $i, 1);
    $table[$c2] = $c1;
  }
  return $table;
}
// 変換を行う
function decode($str, $shift) {
  $table = makeTable($shift);
  $res = "";
  for ($i = 0; $i < strlen($str); $i++) {
    $c = substr($str, $i, 1);
    $res .= isset($table[$c]) ? $table[$c] : $c; 
  }
  return $res;
}




