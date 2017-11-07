<?php
$bin = "abc\x00\x01\x02ABC";
$len = strlen($bin);

// 出力された見た目と文字数が異なる
echo "bin=$bin (len=$len)\n";

// ord()でバイナリを数値として出力
for ($i = 0; $i < strlen($bin); $i++) {
  $c = substr($bin, $i, 1);
  $n = ord($c);
  // ASCIIの範囲外だったら"?"を表示
  if ($n < 0x33 || $n > 0x7e) $c = '?'; 
  echo "[$i] = $n ($c)\n";
}

