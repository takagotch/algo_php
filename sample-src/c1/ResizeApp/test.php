<?php
// ライブラリの自動読み込みを利用する
require 'vendor/autoload.php'; // --- (*1)
// Webから画像(パブリックドメイン)をダウンロード
$photo_url = "https://upload.wikimedia.org/wikipedia/commons/c/c0/Sunflower_head_2015_G1.jpg";
$photo_path = dirname(__FILE__)."/sample.jpg";
if (!file_exists($photo_path)) {
  echo "download photo\n";
  $bin = file_get_contents($photo_url);
  file_put_contents($photo_path, $bin);
}
// 画像を読み込む
$im = new Imagine\Gd\Imagine(); // --- (*2)
$image = $im->open($photo_path);
//  サイズを調べる
$size = $image->getSize();
$w = 256;
$r = $w / $size->getWidth();
$h = floor($r * $size->getHeight());
//  リサイズしてファイルに出力
$image->resize(new Imagine\Image\Box($w, $h))
       ->save('thumb.png');
echo "ok.\n";

