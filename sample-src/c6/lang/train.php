<?php
// FANNを生成
$num_layers = 3;
$num_input = 26;
$num_neuros_hidden = 3;
$num_output = 3;
$ann = fann_create_standard(
  $num_layers, $num_input, 
  $num_neuros_hidden, $num_output);
if (!$ann) { die("FANNの初期化に失敗"); }

// パラメータを設定
fann_set_activation_function_hidden($ann, FANN_SIGMOID_SYMMETRIC);
fann_set_activation_function_output($ann, FANN_SIGMOID_SYMMETRIC);

// 学習する
$desired_error = 0.001;
$max_epochs = 500000;
$epochs_between_reports = 1000;
fann_train_on_file($ann, "lang-train.dat",
  $max_epochs, $epochs_between_reports, $desired_error);
fann_save($ann, 'lang.net');

// 学習したデータをテスト
$lang_data = [
  "1 0 0" => "en",
  "0 1 0" => "tl",
  "0 0 1" => "id",
];
$lang_index = ["en", "tl", "id"];
$testdata = explode("\n",file_get_contents("lang-test.dat"));
array_shift($testdata); // ヘッダは不要
$total = $ok = 0;
while ($testdata) {
  $s = array_shift($testdata);
  if ($s == "") continue;
  $data = explode(" ", $s);
  $label = array_shift($testdata);
  $label_desc = $lang_data[$label];
  $r = fann_run($ann, $data);
  $v = $lang_index[array_max_index($r)];
  echo "- $label_desc = $v\n";
  if ($label_desc == $v) $ok++;
  $total++;
}
echo "結果: $ok/$total\n";

// 配列の中で最も高い数値を持つインデックスを返す
function array_max_index($a) {
  $mv = -1; $mi = -1;
  foreach ($a as $i => $v) {
    if ($mv < $v) {
      $mv = $v; $mi = $i;
    }
  }
  return $mi;
}


