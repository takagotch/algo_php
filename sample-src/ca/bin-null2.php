<?php
$str1 = "abc".chr(0)."def";
$str2 = "abc\x00def";
$str3 = "abc";

var_dump($str1 === $str2); // true
var_dump($str2 === $str3); // false

