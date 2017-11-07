<?php
// 出力サイズの指定
$size_list = [
  // Android
  ["name"=>"android/web-icon.png", "size"=>512],
  ["name"=>"android/mipmap-xxxhdpi/ic_launcher.png", "size"=>192],
  ["name"=>"android/mipmap-xxhdpi/ic_launcher.png",  "size"=>144],
  ["name"=>"android/mipmap-xhdpi/ic_launcher.png",   "size"=>96],
  ["name"=>"android/mipmap-hdpi/ic_launcher.png",    "size"=>72],
  ["name"=>"android/mipmap-mdpi/ic_launcher.png",    "size"=>48],
  ["name"=>"android/mipmap-ldpi/ic_launcher.png",    "size"=>36],
  // iOS
  ["name"=>"ios/Icon.png",      "size"=>57],
  ["name"=>"ios/Icon-72.png",   "size"=>72],
  ["name"=>"ios/Icon-76.png",   "size"=>76],
  ["name"=>"ios/Icon-60@2x.png","size"=>120],
];

// コマンドラインから入力画像を得る
if (count($argv) <= 1) {
  echo "no input"; exit;
}
$input = $argv[1];

// 繰り返しリサイズ処理を行う
foreach ($size_list as $sz) {
  resize_image($input, $sz);
}

// リサイズする
function resize_image($input, $sz) {
  $size = $sz["size"];
  $name = $sz["name"];
  // 画像を読み込む --- (*1)
  $org = imagecreatefrompng($input);
  $x = imagesx($org);
  $y = imagesy($org);
  
  // 新規画像を作成 --- (*2)
  $res = imagecreatetruecolor($size, $size);
  // ブレンドモードを無効に
  imagealphablending($res, false);
  // アルファチャンネルを有効にする
  imagesavealpha($res, true);
  
  // リサイズ --- (*3)
  imagecopyresampled($res, $org, 0, 0, 0, 0, $size, $size, $x, $y);

  // 画像ファイルを出力
  // 出力先指定に新規ディレクトリがあれば作成
  $path = dirname($input)."/".$name;
  $dir = dirname($path);
  if (!file_exists($dir)) mkdir($dir, 0777, true);
  imagepng($res, $path);
  printf("- %3d: %s\n", $size, $path);
}


