<pre><?php
// OpenCV の haarcascades ディレクトリの学習ファイル
$facedb =
  "/usr/local/share/OpenCV/haarcascades/".
  "haarcascade_frontalface_alt2.xml";

// 顔認識
$facefile = 'images/yukata2.jpg';
$faces = face_detect($facefile, $facedb);

// 顔認識の結果を画像に書き込む
$im = imagecreatefromjpeg($facefile);
$red = imagecolorallocate($im, 255, 0, 0);
foreach ($faces as $i => $face) {
  $x = $face["x"];
  $y = $face["y"];
  $w = $face["w"];
  imagerectangle($im, $x, $y, $x + $w, $y + $w, $red);
  echo "[$i] (x:$x, y:$y, w:$w)\n";
}
// 画像を出力
imagejpeg($im, "face-out.jpg");
echo "<img src='face-out.jpg'>";

