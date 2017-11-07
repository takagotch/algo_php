<?php
$haystack = "aaabbbccc";
$needle = "aaa";
// (a) 間違った使い方
if (strpos($haystack, $needle) == FALSE) {
  echo "見つかりません。\n";
} else {
  echo "見つかりました。\n";
}
// (b) 正しい使い方 (===演算子を使うこと)
if (strpos($haystack, $needle) === FALSE) {
  echo "見つかりません。\n";
} else {
  echo "見つかりました。\n";
}


