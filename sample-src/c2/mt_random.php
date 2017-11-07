<?php
// mt19937ar.c をPHPに移植したもの
// パラメーター
$MT_N = 624;
$MT_M = 397;
$MT_UPPER_MASK = 0x80000000;
$MT_LOWER_MASK = 0x7fffffff;
$mt = [];
$mti = $MT_N + 1; // 初期化が必要であることを暗示

// 初期化
function my_mt_srand($seed) {
  global $mt, $mti, $MT_N;
  $mt[0] = $seed & 0xffffffff;
  for ($mti = 1; $mti < $MT_N; $mti++) {
    $mt[$mti] = (1812433253 * ($mt[$mti-1] ^ ($mt[$mti-1] >> 30)) + $mti);
    $mt[$mti] &= 0xffffffff;
  }
}
// 乱数の生成
function my_mt_rand($min, $max) {
  $range = $max - $min + 1;
  return (my_mt_genrand_int32() % $range) + $min;
}
// 32ビット整数の乱数を生成
function my_mt_genrand_int32() {
  global $MT_N, $MT_M, $mt, $mti;
  global $MT_UPPER_MASK, $MT_LOWER_MASK;
  
  static $mag01;
  $mag01 = array(0x0, 0x9908b0df);
  // テーブルの初期化が必要か?
  if ($mti >= $MT_N) {
    if ($mti == $MT_N + 1) my_mt_srand(time());
    // テーブルの再生成
    for ($kk = 0; $kk < $MT_N - $MT_M; $kk++) {
      $y = ($mt[$kk]&$MT_UPPER_MASK)|($mt[$kk+1]&$MT_LOWER_MASK);
      $mt[$kk] = $mt[$kk+$MT_M] ^ ($y >> 1) ^ $mag01[$y & 0x1];
    }
    for (; $kk < $MT_N-1; $kk++) {
      $y =  ($mt[$kk]&$MT_UPPER_MASK)|($mt[$kk+1]&$MT_LOWER_MASK);
      $mt[$kk] = $mt[$kk+($MT_M-$MT_N)] ^ ($y >> 1) ^ $mag01[$y & 0x1];
    }
    $y = ($mt[$MT_N-1]&$MT_UPPER_MASK)|($mt[0]&$MT_LOWER_MASK);
    $mt[$MT_N-1] = $mt[$MT_M-1] ^ ($y >> 1) ^ $mag01[$y & 0x1];
    $mti = 0;
  }
  $y = $mt[$mti++];
  // 焼き戻し
  $y ^= ($y >> 11);
  $y ^= ($y << 7) & 0x9d2c5680;
  $y ^= ($y << 15) & 0xefc60000;
  $y ^= ($y >> 18);
  return $y;
}

// 利用例
my_mt_srand(time()); // 現在時刻で適当に初期化
$list = array('●','▲','■','○','△','□');
for ($i = 0; $i < 256; $i++) {
  $c = $list[my_mt_rand(0, 5)];
  echo $c;
  if ($i % 16 == 15) echo "<br>";
}



