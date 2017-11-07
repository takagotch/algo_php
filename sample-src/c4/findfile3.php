<?php
// 全てのファイルを取得
$f = enumAllFiles(".");
print_r($f);

// テキストファイルだけを取得(正規表現でパターンを指定)
$f = enumAllFiles(".", '/\.txt$/');
print_r($f);

// $path以下の全てのファイルを取得
function enumAllFiles($path, $re_mask = '') {
  $path = rtrim($path, '/');
  $files = scandir($path);
  $res = [];
  foreach ($files as $file) {
    if ($file == ".") continue;
    if ($file == "..") continue;
    $fullpath = $path."/".$file;
    if (is_file($fullpath)) {
      if ($re_mask != '') {
        if (!preg_match($re_mask, $file)) continue;
      }
      $res[] = $fullpath;
      continue;
    }
    if (is_dir($fullpath)) {
      $subf = enumAllFiles($fullpath, $mask);
      $res = array_merge($res, $subf);
    }
  }
  return $res;
}