<?php
$str = "12:33:08";
$pat = '/([0-9]+)\:([0-9]+)\:([0-9]+)/';
echo preg_replace($pat, '$1時$2分$3秒', $str);
echo "\n";

