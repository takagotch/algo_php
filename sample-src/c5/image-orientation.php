<?php
// コマンドラインから画像を取得
if (count($argv) <= 1) {
  echo "no input"; exit;
}
$input = $argv[1];
$outfile = preg_replace('/\.(jpeg|jpg)$/', '-out.jpeg', $input);
$cmpfile = preg_replace('/\.(jpeg|jpg)$/', '-cmp.jpeg', $input);

// 比較用の画像を保存 --- (*1)
$i = new Imagick();
$i->readImage($input);
$i->stripImage(); // すべてのプロパティやコメントを削除
$i->writeImage($cmpfile);
echo "回転前: $outfile\n";

// 回転用に画像を処理 --- (*2)
$img = new Imagick();
$img->readImage($input);
// 画像の向きを自動回転
img_auto_rotate($img);
// 画像を保存
$img->writeImage($outfile);
echo "回転後: $outfile\n";

// 画像の向きを自動回転 --- (*3)
function img_auto_rotate(Imagick $img) {
  switch ($img->getImageOrientation()) {
  case Imagick::ORIENTATION_TOPLEFT:
    break;
  case Imagick::ORIENTATION_TOPRIGHT:
    $img->flopImage();
    break;
  case Imagick::ORIENTATION_BOTTOMRIGHT:
    $img->rotateImage("#000", 180);
    break;
  case Imagick::ORIENTATION_BOTTOMLEFT:
    $img->flopImage();
    $img->rotateImage("#000", 180);
    break;
  case Imagick::ORIENTATION_LEFTTOP:
    $img->flopImage();
    $img->rotateImage("#000", -90);
    break;
  case Imagick::ORIENTATION_RIGHTTOP:
    $img->rotateImage("#000", 90);
    break;
  case Imagick::ORIENTATION_RIGHTBOTTOM:
    $img->flopImage();
    $img->rotateImage("#000", 90);
    break;
  case Imagick::ORIENTATION_LEFTBOTTOM:
    $img->rotateImage("#000", -90);
    break;
  default: 
    break;
  }
  $img->setImageOrientation(Imagick::ORIENTATION_TOPLEFT);
  return $img;
}



