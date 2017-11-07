<?php
$trainfile = 'mnist/svm-train-min.json';
$testfile = 'mnist/svm-t10k-min.json';

// JSONデータを読み出し
$train = json_decode(file_get_contents($trainfile));
$test  = json_decode(file_get_contents($testfile));

// データを学習する
echo "- 学習します\n";
$svm = new SVM();
$model = $svm->train($train);
// 学習結果を保存する
$model->save('mnist/mnist-min.svm');

// 判定
echo "- テストします\n";
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

