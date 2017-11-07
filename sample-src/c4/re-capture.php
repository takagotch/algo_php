<?php
// パターンを指定 (日付形式)
$pat = '#(\d{4})/(\d{1,2})/(\d{1,2})#';
// 文字列
$str = 'Today---2017/09/10---';
// 正規表現マッチ
if (!preg_match($pat, $str, $m)) {
  echo 'マッチしません'; exit;
}
// [0] マッチした全体
echo "[0] 全体 = ".$m[0]."\n";
// [1] 一つ目にマッチした部分
echo "[1] 西暦 = ".$m[1]."\n";
// [2] 二つ目にマッチした部分
echo "[2] 月   = ".$m[2]."\n";
// [3] 三つ目にマッチした部分
echo "[3] 日   = ".$m[3]."\n";

