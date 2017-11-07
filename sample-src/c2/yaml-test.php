<?php
require 'vendor/autoload.php';
use Symfony\Component\Yaml;

// YAMLのデータを定義
$yaml = <<< EOS
# 基本設定
base_setting:
  user: &user hoge
  password: &password hogehoge
# DB1
database1:
  user: *user
  password: *password
  host: 192.168.55.11
# DB2
database2:
  user: *user
  password: *password
  host: 192.168.55.12
EOS;

// YAMLの解析
$parser = new Yaml\Parser();
$data = $parser->parse($yaml);

// 結果をINIファイル風に表示
foreach ($data as $key => $value) {
  echo "[$key]\n";
  foreach ($value as $k => $v) {
    echo "$k=$v\n";
  }
  echo "\n";
}

