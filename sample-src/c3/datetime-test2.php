<?php
// コンストラクタで日時を指定
$dt1 = new DateTime('2017-02-10 12:23:34');
echo $dt1->format('Y-m-d H:i:s')."\n";

// メソッドで指定
$dt2 = new DateTime();
$dt2->setDate(2017, 2, 10)->setTime(12,23,34);
echo $dt2->format('Y-m-d H:i:s')."\n";

