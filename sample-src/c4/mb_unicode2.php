<?php
$str = "\u611b\u3042\u3044\u3046";
$str_dec = json_decode("\"$str\"");
echo $str_dec."\n";

