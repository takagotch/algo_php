<?php
// Average Hashを調べるライブラリ

function makeAHash($file, $cache = TRUE) {
  $hashfile = preg_replace('/\.(jpg|jpeg)$/', '.hash', $file);
  if ($cache) {
    if (file_exists($hashfile)) {
      $v = file_get_contents($hashfile);
      return $v;
    }
  }
  // (1) 16x16にリサイズ
  $sz = 16;
  $src = imagecreatefromjpeg($file);
  $sx = imagesx($src); $sy = imagesy($src);
  $des = imagecreatetruecolor($sz, $sz);
  imagecopyresized($des, $src, 0, 0, 0, 0, $sz, $sz, $sx, $sy);
  imagedestroy($src);
  // (2) グレイスケールに変換
  imagefilter($des, IMG_FILTER_GRAYSCALE);
  // (3) 平均値を得つつ、配列に入れておく
  $pix = []; $sum = 0;
  for ($y = 0; $y < $sz; $y++) {
    for ($x = 0; $x < $sz; $x++) {
      $rgb = imagecolorat($des, $x, $y);
      $b = $rgb & 0xFF;
      $sum += $b;
      $pix[] = $b;
    }
  }
  $ave = floor($sum / ($sz * $sz));
  // (4) 2値化する
  $hash = '';
  foreach ($pix as $i => $v) {
    $hash .= ($v >= $ave) ? '1' : '0';
    if ($i % 16 == 15) $hash .= "\n";
  }
  file_put_contents($hashfile, $hash);
  return $hash;
}


function enumJpeg($path) {
  $files = [];
  $fs = scandir($path);
  foreach ($fs as $f) {
    if (substr($f, 0, 1) == ".") continue;
    $fullpath = $path.'/'.$f;
    if (is_dir($fullpath)) {
      $files = array_merge($files, enumJpeg($fullpath));
      continue;
    }
    if (!preg_match('/\.(jpg|jpeg)$/i', $f)) continue;
    $files[] = $fullpath;
  }
  return $files;
}

