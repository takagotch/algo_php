<?php
// パスフレーズを指定
$passphrase = 'test';

// 秘密鍵を作成する
$conf = [
  'digest_alg'       => 'sha512',
  'private_key_bits' => 2048,
  'private_key_type' => OPENSSL_KEYTYPE_RSA,
];
$pk = openssl_pkey_new($conf);
openssl_pkey_export($pk, $private_key, $passphrase);

// 秘密鍵を元にして公開鍵を作成する
$pub = openssl_pkey_get_details($pk);
$pub_key = $pub["key"];

// 鍵を保存する
file_put_contents("test-private.pem", $private_key);
file_put_contents("test-public.pem", $pub_key);

// どんなものができたのか画面に出力
echo "秘密鍵: ".$private_key."\n";
echo "公開鍵: ".$pub_key."\n";



