<pre><?php
// mt_rand()を使った配列のシャッフル関数
function mt_shuffle(&$a) {
  $a = array_values($a);
  for ($i = count($a) - 1; $i >= 1; $i--) {
    $r = mt_rand(0, $i);
    list($a[$i], $a[$r]) = array($a[$r], $a[$i]);
  }
}

// mt_shuffle()の利用例
$sample_ary = array(1,2,3,4,5);
mt_shuffle($sample_ary);
foreach ($sample_ary as $v) {
  echo $v."\n";
}

