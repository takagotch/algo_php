<?php
// JSONのデータファイルを読む
$json = file_get_contents('lr-data.json');
$data = json_decode($json, TRUE);

// データを学習してモデルを生成する --- (*1)
$svm = new SVM();
$model = $svm->train($data);

// モデルを用いて予測する(左下) --- (*2)
$pre = $model->predict([0.01, 0.12]);
echo $pre."\n";

// 予測する(右上)
$pre = $model->predict([0.9, 0.88]);
echo $pre."\n";

