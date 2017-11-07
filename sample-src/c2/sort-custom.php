<?php
// データを設定
$arr = [
  ['name'=>'Kan', 'point'=>4],
  ['name'=>'Kenji', 'point'=>5],
  ['name'=>'Akai', 'point'=>3],
  ['name'=>'Genta', 'point'=>4],
  ['name'=>'Shizuka', 'point'=>8]
];
// 比較関数
$point_cmp = function ($a, $b) {
  return ($a['point'] < $b['point']) ? -1 : 1;
};
// ソート 
usort($arr, $point_cmp);
// 結果を表示
foreach ($arr as $u) {
  echo $u['name'].":".$u['point']."\n"; 
}

