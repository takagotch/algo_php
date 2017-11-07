<?php
mb_internal_encoding("utf-8");

print_jis("愛愛愛");   // 漢字
print_jis("abc");      // 半角ローマ字
print_jis("ＡＢＣ");   // 全角ローマ字
print_jis("aaa愛aaa"); // 混合

function print_jis($str) {
  $jis = mb_convert_encoding($str, "iso-2022-jp");
  echo "+ $str\n";
  echo "| ".to_hex($jis)."\n";
}

function to_hex($str) {
  $a = str_split($str);
  $a = array_map(function($c){
    return sprintf("%02X",ord($c)); 
  },$a);
  return implode(",",$a);
}

