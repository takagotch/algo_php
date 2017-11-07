<pre><?php
// shuffle()のテスト
$sample_ary = array(1,2,3,4,5);

shuffle($sample_ary);

// 実行結果を表示
foreach ($sample_ary as $v) {
  echo $v."\n";
}



