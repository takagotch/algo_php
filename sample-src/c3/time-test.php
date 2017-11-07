<?php
// タイムゾーンを指定
date_default_timezone_set('Asia/Tokyo');

// 一週間後の日付を表示する
$today = time();
$p7d  = time() + 60 * 60 * 24 * 7;
//
echo "今日　　: ".date('Y-m-d',$today)."\n";
echo "一週間後: ".date('Y-m-d',$p7d)."\n";

