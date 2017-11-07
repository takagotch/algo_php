<?php
$str = "1111,22,33";
$str_a = explode(",", $str);
$b = implode("-", $str_a);
echo "$b\n"; // 1111-22-33

