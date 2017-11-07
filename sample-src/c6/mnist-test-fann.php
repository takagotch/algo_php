<?php
// 文字認識のテスト
$ann = fann_create_from_file("mnist/fann-train.net");
if (!$ann) die("学習データが読めません。");

// テストデータの読み出し
$total = 0;
$ok = 0;
$test_fp = fopen("mnist/fann-t10k.txt","r");
$head = fgets($test_fp);
while (!feof($test_fp)) {
  $input = fgets($test_fp);
  if (trim($input) == "") break;
  $label = floatval(trim(fgets($test_fp))) * 100;
  $input_a = explode(" ", $input);
  // テスト
  $test = fann_run($ann, $input_a);
  $test_v = array_shift($test);
  $test_vi = round($test_v*100);
  if ($test_vi == $label) $ok++;
  $total++;
  $per = $ok / $total * 100;
  printf("- $test_vi=$label,正解率 %5d/%5d = %dper\n", $ok, $total, $per);
}
echo "end.\n";

