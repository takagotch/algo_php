<?php
// 学習済みファイル
$svmfile = dirname(dirname(__FILE__)).'/mnist/mnist-min.svm';
// 引数を得る
$input = isset($_GET['in']) ? $_GET['in'] : '';
if ($input == '') {
  echo "no input\n"; exit;
}
// 引数をSVMの入力に直す
$si = [];
for ($i = 0; $i < 784; $i++) {
  $c = intval(substr($input, $i, 1));
  $si[] = $c;
}
// 学習済みファイルを読み込む
$model = new SVMModel();
$model->load($svmfile);
$label = $model->predict($si);
echo "$label\n";

