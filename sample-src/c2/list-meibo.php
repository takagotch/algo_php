<?php

// 名簿リストを初期化
$meibo = array();

// 人を名簿に追加
$person = array(
  "name" => "Nami",
  "age"  => 18
);
array_push($meibo, $person);

// 人を名簿に追加
$person = array(
  "name" => "Sanji",
  "age"  => 20
);
array_push($meibo, $person);

// 人を名簿に追加
$person = array(
  "name" => "Takeshi",
  "age"  => 28
);
array_push($meibo, $person);

// ランダムに一件の名簿の内容を表示
$r = rand(0, count($meibo) - 1);
$p = $meibo[$r];
echo "name:". $p["name"]."\n";
echo "age :". $p["age"]."\n";

