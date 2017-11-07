<?php
require_once 'stack.class.php';

// スタックにデータを追加
$t = new Stack();
$t->push("Panda");
$t->push("Tiger");
$t->push("Bird");

// スタックのデータを全て表示する
while ($v = $t->pop()) {
  echo "[$v]\n";
}

