<?php
$DAY = 60 * 60 * 24;
$t1 = strtotime("2019-9-20");
$t2 = strtotime("2018-1-1");

$diff = ($t1 - $t2) / $DAY;
echo $diff."日\n";

