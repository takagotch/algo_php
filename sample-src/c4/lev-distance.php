<?php
// レーベンシュタイン距離を求める関数
function calc_distance($a, $b) {
  if ($a == $b) return 0;
  $a_len = mb_strlen($a);
  $b_len = mb_strlen($b);
  if ($a == "") return $b_len;
  if ($b == "") return $a_len;
  // 二次元の表を用意する
  $matrix = array_fill(0, $a_len + 1, []);
  for ($i = 0; $i <= $a_len; $i++) {
    $matrix[$i] = array_fill(0, $b_len + 1, 0);
  }
  // 0の時の初期値をセット
  for ($i = 0; $i <= $a_len; $i++) {
    $matrix[$i][0] = $i;
  }
  for ($j = 0; $j <= $b_len; $j++) {
    $matrix[0][$j] = $j;
  }
  // 表を埋めていく --- (*1)
  for ($i = 1; $i <= $a_len; $i++) {
    for ($j = 1; $j <= $b_len; $j++) {
      $ac = mb_substr($a, $i-1, 1);
      $bc = mb_substr($b, $j-1, 1);
      $cost = ($ac == $bc) ? 0 : 1;
      $matrix[$i][$j] = min([
        $matrix[$i-1][$j] + 1,       // 文字の挿入
        $matrix[$i][$j-1] + 1,       // 文字の削除
        $matrix[$i-1][$j-1] + $cost  // 文字の置換
      ]);
    }
  }
  return $matrix[$a_len][$b_len];
}

// 実行テスト
$base = "イカダ";
$list = [
  $base,
  "イカスミ",
  "カナダ",
  "イカ",
  "サカナ",
  "サンマ",
];
usort($list, function($a, $b) use($base) {
  $a_dist = calc_distance($base, $a);
  $b_dist = calc_distance($base, $b);
  return $a_dist - $b_dist;
});
foreach ($list as $w) {
  $dist = calc_distance($base, $w);
  echo "{$dist}\t{$w}\n";
}



