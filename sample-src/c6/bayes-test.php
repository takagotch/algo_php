<?php
// ライブラリの取り込み
require 'vendor/autoload.php';
use Fieg\Bayes\Classifier;
use Fieg\Bayes\Tokenizer\WhitespaceAndPunctuationTokenizer;

// 単語分割器と分類器の生成
$tokenizer = new WhitespaceAndPunctuationTokenizer();
$classifier = new Classifier($tokenizer);

// 単語を学習させる
$classifier->train('en', 'This is a pen.');
$classifier->train('en', 'He is my friend.');
$classifier->train('ja', 'Kore ha pen desu.');
$classifier->train('ja', 'Kare ha watasi no tomodati desu.');
$classifier->train('cn', 'Zhe shi qian bi.');
$classifier->train('cn', 'Ta shi wo de peng you.');

// 分類してみる
$result = $classifier->classify('This is a test.');

// 結果を表示
var_dump($result);
