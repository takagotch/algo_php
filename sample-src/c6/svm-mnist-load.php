<?php
// モデルを読み込む
$model = new SVMModel();
$model->load('mnist/mnist.svm');
// 予測する
$list = json_decode(file_get_contents('mnist/svm-t10k-min.json'));
$data = array_shift($list);
$label = array_shift($data);
$result = $model->predict($data);
echo "$label <=> $result\n";


