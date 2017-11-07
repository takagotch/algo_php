<img src="images/food.jpg"><hr>
<?php
// Exif情報を得る
$exif = exif_read_data("images/food.jpg");
// 位置情報(GPS)を一般的な形式に変換
$latlng = exif_gps_latlng($exif);
if ($latlng == false) {
  echo 'No GPS Data'; exit;
}
// Google Mapsへのリンクを作成
$mapurl = "https://www.google.com/maps?q=loc:$latlng";
echo <<< EOS
<a href="$mapurl" target="_blank">GPS={$latlng}</a>
EOS;

function exif_gps_latlng($exif) {
  if (!isset($exif['GPSLatitudeRef'])) return false;
  $lat = exif_gps_60to10(
    $exif['GPSLatitudeRef'], $exif['GPSLatitude']);
  $lng = exif_gps_60to10(
    $exif['GPSLongitudeRef'], $exif['GPSLongitude']);
  return "$lat,$lng"; 
}

// Exifタグの情報を反映させる
function exif_gps_60to10($ref, $v) {
  $v1 = exif_float($v[0]); // 度
  $v2 = exif_float($v[1])/60; // 分
  $v3 = exif_float($v[2])/3600; // 秒
  $r = $v1 + $v2 + $v3;
  if ($ref == 'S' || $ref == 'W') $r *= -1;
  return $r;
}
// a/b 形式の文字列を数値に変換
function exif_float($v) {
  $a = explode('/', $v."/1");
  return floatval($a[0]) / floatval($a[1]);
}


