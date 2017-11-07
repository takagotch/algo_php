<?php
// カラーヒストグラムライブラリ

// 画像からカラーヒストグラムを作成する
function makeHistogram($path, $cache = TRUE) {
  // 結果を保存するファイル
  $csvfile = preg_replace('/\.(jpg|jpeg)$/', '-his.csv', $path);
  if ($cache) { // ヒストグラムのキャッシュを使うか
    if (file_exists($csvfile)) {
      $s = file_get_contents($csvfile);
      return explode(",", $s);
    }
  }
  $im = imagecreatefromjpeg($path);
  $sx = imagesx($im);
  $sy = imagesy($im);
  // ピクセルを数える
  $his = array_fill(0, 64, 0);
  for ($y = 0; $y < $sy; $y++) {
    for ($x = 0; $x < $sx; $x++) {
      $rgb = imagecolorat($im, $x, $y);
      $no = rgb2no($rgb);
      $his[$no]++;
    }
  }
  // 8bitに正規化
  $pixels = $sx * $sy;
  for ($i = 0; $i < 64; $i++) {
    $his[$i] = floor(256 * $his[$i] / $pixels);
  }
  file_put_contents($csvfile, implode(",", $his));
  return $his;
}

// ヒストグラムのビンを計算
function rgb2no($rgb) {
  $r = ($rgb >> 16) & 0xFF;
  $g = ($rgb >> 8) & 0xFF;
  $b = $rgb & 0xFF;
  $rn = floor($r / 64);
  $gn = floor($g / 64);
  $bn = floor($b / 64);
  return 16 * $rn + 4 * $gn + $bn;
}

// Jpegを列挙する
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












