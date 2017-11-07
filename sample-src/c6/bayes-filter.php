<?php
// ライブラリの取り込み
require_once 'vendor/autoload.php';
require_once 'MecabTokenizer.php';
use Fieg\Bayes\Classifier;

// 単語分割器と分類器の生成
$tokenizer = new MecabTokenizer();
$classifier = new Classifier($tokenizer);

// 単語を学習させる
$classifier->train('迷惑', 'とにかく安いので一度見に来てね。');
$classifier->train('迷惑', '驚異のリピート率。高額時給のバイトを紹介します。');
$classifier->train('迷惑', 'ついに解禁。神秘の薬。あなただけに教えます。');
$classifier->train('重要', '返却予定日のお知らせ。');
$classifier->train('重要', 'いつもお世話になっております。予定の確認です。');
$classifier->train('重要', 'オークション落札のお知らせです。');

// 分類してみる
$s = 'プロジェクトAの件で予定を確認させてください。';
$r1 = $classifier->classify($s);
echo "--- $s\n";
print_r($r1);

$s = 'とにかく安さが自慢のお店です。見てください。';
$r2 = $classifier->classify($s);
echo "--- $s\n";
print_r($r2);

