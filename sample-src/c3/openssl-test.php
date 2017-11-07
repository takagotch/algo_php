<?php
// サンプルデータ
$text = <<< EOS
険しい丘に登るためには、
最初にゆっくり歩くことが必要である。
  - シェイクスピア
EOS;
// 暗号化のためのパラメータ
$password = "XwJGMOmYmZK06SjJ"; // 鍵を指定
$method = 'aes-256-cbc'; // 暗号化メソッドを指定
$iv_a = [ // 初期化ベクトル
  223,156,39,243,44,53,136,185,62,154,223,69,84,246,181,219,
  98,18,130,90,150,222,24,220,46,134,135,151,18,104,103,117];
$iv = implode("", array_map("chr", $iv_a));
$opt = 0; // オプション

// 初期化ベクトルの長さを調べてサイズを調節
$iv_len = openssl_cipher_iv_length($method);
$iv = substr($iv, 0, $iv_len);

// 暗号化
$enc = openssl_encrypt($text, $method, $password, $opt, $iv);
// 復号化
$dec = openssl_decrypt($enc, $method, $password, $opt, $iv);

// 結果を表示
echo "初期化ベクトルの長さ: $iv_len\n";
echo "- 暗号化 -\n$enc\n";
echo "- 復号化 -\n$dec\n";

