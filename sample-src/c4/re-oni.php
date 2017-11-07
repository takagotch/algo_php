<?php
mb_regex_encoding('utf-8');

$str = "12:33:08";
$pat = '([0-9]+)\:([0-9]+)\:([0-9]+)';
echo mb_ereg_replace($pat, '\1時\2分\3秒', $str);
echo "\n";

