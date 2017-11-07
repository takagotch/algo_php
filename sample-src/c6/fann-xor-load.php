<?php
// 学習済みデータを読み込み
$ann = fann_create_from_file('fann-xor.net');

// テスト
$xor_pattern = [[0,0],[0,1],[1,0],[1,1]];
foreach ($xor_pattern as $x) {
  $r = fann_run($ann, $x);
  printf("%d %d => %d\n", $x[0], $x[1], round($r[0]));
}

