<?php
//
// 味噌ラーメンと塩ラーメンを判定する
//
require_once 'histogram-lib.inc.php';
// アップロードフォーム
$up_form = <<<EOS
<h3>味噌ラーメンと塩ラーメンの判定</h3>
<div style="border:1px solid silver;padding:12px">
  JPEGファイルを選択してください。<br>
  <form enctype="multipart/form-data" method="POST">
  <input name="upfile" type="file"><br>
  <input type="submit" value="アップロード">
</form></div>
EOS;
$head = '<html><meta charset="utf-8"><body>';
$foot = '</body></html>';
// アップロードされてなければフォームを表示
if (empty($_FILES['upfile']['tmp_name'])) {
  echo $head.$up_form.$foot;
  exit;
}
// アップロードされた写真をコピー
$upfile = dirname(__FILE__).'/upfile.jpg';
move_uploaded_file($_FILES['upfile']['tmp_name'], $upfile);
// ヒストグラムを作成
$target = make_histogram($upfile, false);
// 塩か味噌かを判定
$ann = fann_create_from_file("ramen.net");
$res = fann_run($ann, $target);
$ramen_type = ["味噌ラーメン", "塩ラーメン"];
echo $head;
echo "<div style='text-align:center'><h2>アップした写真</h2>";
echo "<img src='upfile.jpg' width=300><br>";
foreach ($res as $i => $v) {
  $per = floor(100*$v);
  if ($per < 0) $per = 0; 
  $type = $ramen_type[$i];
  $fsize = round(2 * $v);
  if ($fsize < 1) $fsize = 1;
  echo "<span style='font-size:{$fsize}em'>{$type}：{$per}%</span><br>";
}
echo "<p><a href='ramen-ui.php'>他を調べる</a></p></div>";
echo $foot;

