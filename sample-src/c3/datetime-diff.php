<?php
// 東京オリンピック日時
$tokyo1 = new DateTime('1964-10-10');
$tokyo2 = new DateTime('2020-07-24');
// 差を求める
$diff = $tokyo1->diff($tokyo2);
echo $diff->format('%R %a 日')."\n";
echo $diff->format('%R %y年 %mヶ月 %d日')."\n";



