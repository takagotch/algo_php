<?php
$t1 = strtotime("2018-1-1");
$t2 = strtotime("+3 month", $t1);
echo date('Y-m-d', $t2)."\n";

