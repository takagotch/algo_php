<?php
// 学習ファイルの名前
// $trainfile = "mnist/fann-train.txt";
$trainfile = "mnist/fann-train-min.txt";

// FANNのパラメーターを設定
$num_input = 28 * 28; // ピクセル数
$num_output = 1;
$num_layers = 3;
$num_neuros_hidden = 50;
$desired_error = 0.0005;
$max_epochs = 500000;
$epochs_between_reports = 10;
$lerning_rate = 0.05;

// FANNを生成
$ann = fann_create_standard(
  $num_layers, $num_input, $num_neuros_hidden, $num_output);
if (!$ann) { die("FANNの初期化に失敗"); }
fann_set_callback($ann, 'ann_callback');

// パラメータを設定
fann_set_training_algorithm($ann, FANN_TRAIN_INCREMENTAL);
fann_set_learning_rate($ann, $lerning_rate);
//fann_set_activation_steepness_hidden($ann, 1.0);
//fann_set_activation_steepness_output($ann, 1.0);

fann_set_activation_function_hidden($ann, FANN_SIGMOID_SYMMETRIC);
fann_set_activation_function_output($ann, FANN_SIGMOID_SYMMETRIC);

fann_set_bit_fail_limit($ann, 0.01);
fann_set_train_stop_function($ann, FANN_STOPFUNC_BIT);

// 学習する
fann_train_on_file(
  $ann, $trainfile,
  $max_epochs, $epochs_between_reports, $desired_error);

// test
$j = 0;
$fp = fopen("mnist/fann-t10k-min.txt", "r");
//$fp = fopen($trainfile, "r");
fgets($fp);
while(!feof($fp)) {
  $input = trim(fgets($fp));
  if ($input == "") break;
  $label = floatval(trim(fgets($fp)))*100;
  $input_a = explode(" ", $input);
  foreach($input_a as $i => $v) {
    $input_a[$i] = floatval($v);
  }
  $r = fann_run($ann, $input_a);
  $v = array_shift($r);
  $vi = ceil($v * 100);
  echo "- test [$label]=$vi --- $v\n";
  if ($j >= 5) { break; }
  $j++;
}


// 学習データを保存する
fann_save($ann, "mnist/fann-train.net");
echo "ok\n";

function ann_callback( $ann, $train_data, $max_epochs, $epochs_between_reports, $desired_error, $epochs ) {
  var_dump($ann);
  var_dump($train_data);
  var_dump($max_epochs);
  var_dump($epochs_between_reports);
  var_dump($desired_error);
  var_dump($epochs);
  echo "--- ann_callback ---\n";
}


