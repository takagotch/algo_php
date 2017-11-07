<html><body style="font-size:32px; line-height:32px;">
<?php
// 表示したい色を指定
$colors = array("red", "blue", "yellow", "green", "black");
// 16x16のタイルを描画
for ($i = 0; $i < 256; $i++) {
  $r = rand(0, count($colors)-1);
  $c = $colors[$r];
  echo "<span style='color:$c'>■</span>";
  if ($i % 16 == 15) echo "<br>";
}
?></body></html>


