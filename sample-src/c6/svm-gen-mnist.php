<?php
// 簡易版
convert_mnist(
  "mnist/train-labels-idx1-ubyte.gz",
  "mnist/train-images-idx3-ubyte.gz",
  "mnist/svm-train-min.json", 1000, FALSE);
convert_mnist(
  "mnist/t10k-labels-idx1-ubyte.gz",
  "mnist/t10k-images-idx3-ubyte.gz",
  "mnist/svm-t10k-min.json", 1000, FALSE);
// フルセットのデータを生成
convert_mnist(
  "mnist/train-labels-idx1-ubyte.gz",
  "mnist/train-images-idx3-ubyte.gz",
  "mnist/svm-train.json", 999999);
convert_mnist(
  "mnist/t10k-labels-idx1-ubyte.gz",
  "mnist/t10k-images-idx3-ubyte.gz",
  "mnist/svm-t10k.json", 999999);

function convert_mnist($label_f, $image_f, $output, $limit = 999999, $cache = TRUE) {
  if ($cache) {
    if (file_exists($output)) return;
  }
  // 圧縮を解く
  $label_f2 = str_replace('.gz', '', $label_f);
  $image_f2 = str_replace('.gz', '', $image_f);
  gz_uncomp($label_f, $label_f2);
  gz_uncomp($image_f, $image_f2);
  // ファイルを開く
  $label_fp = fopen($label_f2, "r");
  $image_fp = fopen($image_f2, "r");
  $out_fp = fopen($output, "w");
  // マジックナンバーをチェック
  $mag = fread_int32($label_fp);
  if ($mag !== 0x0801) die("ファイル破損:$label_f");
  $mag = fread_int32($image_fp);
  if ($mag !== 0x0803) die("ファイル破損:$image_f");
  // アイテム数を確認
  $num_items = fread_int32($label_fp);
  $num_items = fread_int32($image_fp);
  echo "アイテム数: $num_items\n";
  // 行列のピクセル数
  $num_rows = fread_int32($image_fp);
  $num_cols = fread_int32($image_fp);
  $num_pix = $num_rows * $num_cols;
  echo "行列: $num_cols x $num_rows\n";
  if ($limit < $num_items) $num_items = $limit;
  fwrite($out_fp, "[");
  
  // 各データを読み出して出力
  for ($i = 0; $i < $num_items; $i++) {
    $label = $lno = fread_b($label_fp);
    $images = []; $values = [];
    for ($j = 0; $j < $num_pix; $j++) {
      $images[] = $v = fread_b($image_fp);
      //if ($v == 0) continue;
      $values[$j] = $v / 255;
    }
    // 本当に取り出せたかPGMに保存してテスト
    if ($i < 10) {
      $s = "P2 28 28 255\n";
      $s .= implode(" ", $images);
      file_put_contents("mnist/test-$i-$lno.pgm", $s);
    }
    if ($i % 1000 == 0) {
      echo "[$i/$num_items] $label - ".implode(",", $images)."\n";
    }
    // 書き込む
    fwrite($out_fp,
      "[".$label.",".implode(",", $values)."]");
    if ($i > $limit) break;
    if ($i == ($num_items-1)) {
      fwrite($out_fp, "\n");
    } else {
      fwrite($out_fp, ",\n");
    }
  }
  fwrite($out_fp, "]\n");
  echo "[ok] $output\n";
}

function fread_int32($fp) {
  $c4 = fread($fp, 4);
  return array_shift(unpack("N", $c4));
}
function fread_b($fp) {
  $c = fread($fp, 1);
  return ord($c);
}

function gz_uncomp($in, $out) {
  $raw = gzdecode(file_get_contents($in));
  file_put_contents($out, $raw);
}


