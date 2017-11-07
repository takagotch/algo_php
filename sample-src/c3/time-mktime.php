<?php
$t1 = mktime(0,0,0,9,20,2019);
$t2 = strtotime("2019-9-20");

echo date("Y-m-d", $t1)."\n";
echo date("Y-m-d", $t2)."\n";

