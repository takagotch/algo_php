<?php
// ファイルの一覧を取得
$path = "."; // カレントディレクトリ
exec("find \"$path\" -type f", $filelist);
print_r($filelist);

