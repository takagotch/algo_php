<?php
$trainfile = 'mnist/svm-train-min.json';
$testfile = 'mnist/svm-t10k-min.json';

// データを学習する
echo "- データを読みます\n";
$svm = new SVM();
$train = json_decode(file_get_contents($trainfile));

echo "- 学習します\n";
$model = $svm->train($train);
$train = [];
$model->save('mnist/mnist-min.svm');

// 判定
echo "- テストします\n";
$test  = json_decode(file_get_contents($testfile));
$total = 0;
$ok = 0;
foreach ($test as $data) {
  if (!$data) continue;
  $label = array_shift($data);
  $pre = $model->predict($data);
  if ($pre == $label) $ok++;
  $total++;
}

// 結果
echo "- 結果表示\n";
$per = round($ok / $total * 100);
echo "結果: $ok/$total\n";
echo "精度: {$per}%\n";

