<?php
// コマンドラインから画像を取得
if (count($argv) <= 1) {
  echo "no input"; exit;
}
$input = $argv[1];
// 出力ファイルを決める
$out = preg_replace('/\.(jpeg|jpg)$/', '-out.jpeg', $input);
$cmp = preg_replace('/\.(jpeg|jpg)$/', '-cmp.jpeg', $input);

// Exif情報を得る --- (*1)
$exif = exif_read_data($input);
// Exif情報から回転角度を調査
$ori = isset($exif["Orientation"]) ? $exif["Orientation"] : 0;
$rot_table = [0,0,0,180,0,270,90,90,270]; // 回転角度
$deg = $rot_table[$ori];

// 画像を読み込む
$im = imagecreatefromjpeg($input);

// 比較のためExif情報を削除した画像を保存 --- (*2)
$sx = imagesx($im);
$sy = imagesy($im);
$cmp_im = imagecreatetruecolor($sx, $sy);
imagecopy($cmp_im, $im, 0, 0, 0, 0, $sx, $sy);
imagedestroy($im);
imagejpeg($cmp_im, $cmp); // 比較用画像を保存
echo "-回転前: $out\n";
$im = $cmp_im;

// 画像を回転させる --- (*3)
if ($deg > 0) {
  $rot_im = imagerotate($im, 360-$deg, 0);
  imagedestroy($im);
  $im = $rot_im;
  echo "-　角度: $deg\n";
}

// 結果をファイルに出力
imagejpeg($im, $out);
echo "-回転後: $out\nok\n";

