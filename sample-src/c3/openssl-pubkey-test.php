<?php
// 設定を読み込む
$passphrase = "test";
$pub_key = file_get_contents("test-public.pem");
$pri_key = file_get_contents("test-private.pem");
// 暗号化したいデータ
$text = <<< EOS
大切なのは、疑問を持ち続けることだ。
神聖な好奇心を失ってはならない。
by アインシュタイン　
EOS;

// 暗号化 (公開鍵を利用) --- (*1)
openssl_public_encrypt($text, $enc, $pub_key);
echo "暗号化: ".base64_encode($enc)."\n";

// 復号化 (秘密鍵を利用) --- (*2)
$pri = openssl_get_privatekey($pri_key, $passphrase);
openssl_private_decrypt($enc, $data, $pri);
echo "復号化: ".$data."\n";

