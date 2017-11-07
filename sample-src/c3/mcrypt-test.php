<?php
// サンプル文字列
$text = <<< EOS
石を投げ捨てるのに時があり，石を集めるのに時がある。
抱擁するのに時があり，抱擁を控えるのに時がある。
EOS;
// 暗号化のためのパラメータ
$key = "AqhxUS0EY2Ie"; // 鍵
$iv_a = [ // 初期化ベクトル
    75,15,164,7,154,169,147,105,198,85,38,82,209,213,14,75,
    44,206,201,161,232,99,249,185,255,5,176,31,155,14,170,22];
$iv = implode("", array_map('chr', $iv_a)); // データ列を文字列に変換

// 暗号化と複合化を行う
$enc = encrypt($text, $key, $iv);
$dec = decrypt($enc, $key, $iv);
echo "- 暗号化 -\n".base64_encode($enc)."\n";
echo "- 復号化 -\n".$dec."\n";

// 暗号化を行う
function encrypt($data, $key, $iv) {
  // 暗号化モジュールを開く --- (*1)
  $td = mcrypt_module_open('rijndael-256', '', 'cbc', '');
  // 初期化ベクトルのサイズを調整 --- (*2)
  $iv = substr($iv, 0, mcrypt_enc_get_iv_size($td));
  // 暗号化する --- (*3)
  mcrypt_generic_init($td, $key, $iv);
  $enc = mcrypt_generic($td, $data);
  mcrypt_generic_deinit($td);
  // モジュールを閉じる --- (*4)
  mcrypt_module_close($td);
  return $enc;
}

// 復号化を行う
function decrypt($enc, $key, $iv) {
  // 暗号化モジュールを開く
  $td = mcrypt_module_open('rijndael-256', '', 'cbc', '');
  // 初期化ベクトルのサイズを調整
  $iv = substr($iv, 0, mcrypt_enc_get_iv_size($td));
  // 復号化する
  mcrypt_generic_init($td, $key, $iv);
  $dec = mdecrypt_generic($td, $enc);
  mcrypt_generic_deinit($td);
  // モジュールを閉じる
  mcrypt_module_close($td);
  // データ終端をトリムする
  // $dec = rtrim($dec);
  return $dec;
}

