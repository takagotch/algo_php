<?php
include_once 'ahash-common.inc.php';

define("PHOTO_PATH", "images");

$up_form = <<<EOS
<h3>類似画像検索(Average Hash)</h3>
<div style="border:1px solid silver;padding:12px">
  JPEGファイルを選択してください。<br>
  <form enctype="multipart/form-data" method="POST">
  <input name="upfile" type="file"><br>
  <input type="submit" value="アップロード">
</form></div>
EOS;
$head = '<html><meta charset="utf-8"><body>';
$foot = '</body></html>';

if (empty($_FILES['upfile']['tmp_name'])) {
  echo $head.$up_form.$foot;
  exit;
}

$upfile = dirname(__FILE__).'/upfile.jpg';
move_uploaded_file($_FILES['upfile']['tmp_name'], $upfile);

$target = makeAHash($upfile, false);
$files = enumJpeg(PHOTO_PATH);
$result = checkHash($target, $files);
$top6 = array_slice($result, 0, 6);
echo $head;
echo "<div style='text-align:center'><h2>アップした写真</h2>";
echo "<img src='upfile.jpg' width=300>";
echo "<h2>以下類似する順番に表示</h2>";
foreach ($top6 as $f) {
  $path = $f['path'];
  $value = $f['value'];
  echo "<img src='$path' width=300 alt='$value:$path'>";
}
echo "</div>".$foot;

// ハッシュから類似度を算出
function checkHash($target, $files) {
  $list = [];
  foreach ($files as $file) {
    $hash = makeAHash($file);
    $match = 0;
    for ($i = 0; $i < strlen($target); $i++) {
      if (substr($target,$i,1) == substr($hash,$i,1)) $match++;
    }
    $list[] = [
      "path" => $file,
      "value" => $match,
    ];
  }
  // ソート
  usort($list, function ($a, $b) {
    return $b['value'] - $a['value'];
  });
  return $list;
}




