<?php
// ファイルの一覧を取得
$path    = ".";     // カレントディレクトリ
$pattern = "*.txt"; // テキストファイルのみ取得
exec("find \"$path\" -type f -name \"$pattern\"", $filelist);
print_r($filelist);

