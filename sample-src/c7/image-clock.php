<?php
//
// アナログ時計を描画 
//
$width  = 600;
$height = 600;
$cx = $width / 2;
$cy = $height / 2;

initCanvas($width, $height);
drawClock();
imagepng($img, "image-clock.png");

function drawClock() {
  global $img, $black, $red, $blue;
  global $cx, $cy, $width;
  // 時計の背景を描画
  $r = $width - 10;
  imagearc($img, $cx, $cy, $r, $r, 0, 360, $black);
  // 時間を取得
  $h = date("H") % 12;
  $m = date("i");
  $s = date("s");
  // 針を描画
  drawHand(($h/12) * 360, 0.5, 20, $black);
  drawHand(($m/60) * 360, 0.7, 10, $blue);
  drawHand(($s/60) * 360, 0.9, 3, $red);
  // デジタル時計を描画
  $font = dirname(__FILE__).'/font/ipagp.ttf';
  imagettftext($img, 
    20, 0, 10, 30, $black, $font, 
    "$h:$m:$s");
}

// 時計の針を描く
function drawHand($angle, $rlen, $width, $color) {
  global $img, $black;
  global $cx, $cy;
  $angle -= 90;
  $len = $rlen * $cx;
  $dx = $cx + cos(deg2rad($angle)) * $len;
  $dy = $cy + sin(deg2rad($angle)) * $len;
  drawline($img, $cx,$cy, $dx,$dy, $width, $color);
}

// 幅$widthの太線を引く
function drawline($img, $x1,$y1, $x2,$y2, $width, $color) {
  if ($width <= 1) {
    return imageline($img, $x1,$y1, $x2,$y2, $color);
  }
  $t = $width / 2 - 0.5;
  if ($x1 == $x2 || $y1 == $y2) {
    return imagefilledrectangle($img,
      round(min($x1,$x2)-$t),
      round(min($y1,$y2)-$t),
      round(max($x1,$x2)+$t),
      round(max($y1,$y2)+$t), $color);
  }
  $k = ($y2 - $y1) / ($x2 - $x1);
  $a = $t / sqrt(1 + pow($k, 2));
  $k1p = (1+$k) * $a;
  $k1m = (1-$k) * $a;
  $points = [
    round($x1 - $k1p), round($y1 + $k1m),
    round($x1 - $k1m), round($y1 - $k1p),
    round($x2 + $k1p), round($y2 - $k1m),
    round($x2 + $k1m), round($y2 + $k1p),
  ];
  return imagefilledpolygon($img, $points, 4, $color);
}

// キャンバスを初期化する
function initCanvas($w, $h) {
  global $img, $black, $red, $blue;
  $img = imagecreatetruecolor($w, $h);
  $white = imagecolorallocate($img, 255,255,255);
  $black = imagecolorallocate($img, 0, 0, 0);
  $red = imagecolorallocate($img, 255, 0, 0);
  $blue = imagecolorallocate($img, 0, 0, 255);
  imagefilledrectangle($img, 0, 0, $w, $h, $white);
  imagerectangle($img, 0, 0, $w-1, $h-1, $black);
}
?><html><head>
<!-- 強引にmetaタグで毎秒更新 -->
<meta http-equiv="refresh" content="1; URL=image-clock.php">
</head><body>
<img src="image-clock.png?m=<?php echo time()?>">
</body></html>

