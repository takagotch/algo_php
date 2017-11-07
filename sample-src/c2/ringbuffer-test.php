<?php
require_once 'ringbuffer.class.php';

// 五件のログを記録するリングバッファを作る
$rb = new RingBuffer(5);
// ログを追加
$rb->append("A is Apple.");
$rb->append("B is Banana.");
$rb->append("C is Cute.");
$rb->append("D is Desk.");
$rb->append("E is Easy.");
$rb->append("F is Flight.");
$rb->append("G is Good.");
// 5件のログを順に表示
for ($i = 0; $i < 5; $i++) {
  $log = $rb->get($i);
  echo "[$log]\n";
}

