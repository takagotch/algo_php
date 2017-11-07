<?php
// 配列を適当な順番で初期化
$a = [0, 1];
$a[5] = 5;
$a[4] = 4;
$a[2] = 2;
$a[3] = 3;
// for文で配列$aの一覧を表示
for ($i = 0; $i < count($a); $i++) {
  echo $a[$i]."\n";
}
echo "---\n";
// foreach文で配列$aの一覧を表示
foreach ($a as $e) {
  echo $e."\n"; 
}


