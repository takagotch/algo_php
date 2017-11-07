<?php
function ngram($str, $num) {
  $list = [];
  $len = mb_strlen($str) - $num + 1;
  for ($i = 0; $i < $len; $i++) {
    $list[] = mb_substr($str, $i, $num);
  }
  return $list;
}
function trigram($str) {
  return ngram($str, 3);
}

function calc_common($sa, $sb) {
  $a = trigram($sa);
  $b = trigram($sb);
  $cnt_a = count($a);
  $cnt_c = count(array_intersect($a, $b));
  $per = floor($cnt_c / $cnt_a * 100);
  echo "一致: $cnt_c / $cnt_a = {$per}%\n";
}

calc_common(
  "浅草で美味しいウナギを食べた。",
  "ウナギを浅草で食べたが美味しかった。"
);

