<?php
// FANNのパラメーターを設定
$num_input = 2;
$num_output = 1;
$num_layers = 3;
$num_neuros_hidden = 4;
$desired_error = 0.01;
$max_epochs = 500000;
$epochs_between_reports = 1000;

// FANNを生成
$ann = fann_create_standard(
  $num_layers, $num_input, 
  $num_neuros_hidden, $num_output);
if (!$ann) { die("FANNの初期化に失敗"); }
fann_set_callback($ann, 'ann_callback');

// パラメータを設定
fann_set_activation_function_hidden($ann, FANN_ELLIOT_SYMMETRIC);
fann_set_activation_function_output($ann, FANN_ELLIOT_SYMMETRIC);
fann_set_training_algorithm($ann, FANN_TRAIN_INCREMENTAL);

// 学習する
$t = fann_create_train(4, 2, 1);
print_r($t);
// - XORのデータファイルを読み込む
$xor_data = [
  [ [1,1], [0] ],
  [ [1,0], [1] ],
  [ [0,1], [1] ],
  [ [0,0], [0] ]
];
foreach ($xor_data as $x) {
  fann_reset_MSE($ann);
  fann_train($ann, $x[0], $x[1]);
  echo fann_get_MSE($ann).PHP_EOL;
}

// 学習したデータをテスト
echo "学習結果をテスト:\n";
$xor_pattern = [[1,1],[1,0],[0,1],[0,0]];
foreach ($xor_pattern as $t) {
  $r = fann_run($ann, $t);
  $v = round($r[0]);
  printf("%d %d => %d (%f)\n", $t[0], $t[1], $v, $r[0]);
}
fann_destroy($ann);

function ann_callback( $ann, $train_data, $max_epochs, $epochs_between_reports, $desired_error, $epochs ) {
  var_dump($ann);
  var_dump($train_data);
  var_dump($max_epochs);
  var_dump($epochs_between_reports);
  var_dump($desired_error);
  var_dump($epochs);
}

