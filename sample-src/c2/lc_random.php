<?php
// 乱数の初期値(seed)
$lc_seed = 1;
// 乱数を生成する関数
function lc_rand() {
  global $lc_seed;
  $MASK = 0xffffffff;
  $lc_seed = (1103515245 * $lc_seed + 12345) & $MASK;
  return ($lc_seed / 65536) % 32768;
}
// 乱数を初期化する関数
function lc_srand($seed) {
  global $lc_seed;
  $lc_seed = $seed;
}

// 利用例
lc_srand(time()); // 現在時刻で適当に初期化
$list = array('●','▲','■','○','△','□');
for ($i = 0; $i < 256; $i++) {
  $c = $list[lc_rand() % 6];
  echo $c;
  if ($i % 16 == 15) echo "<br>";
}

