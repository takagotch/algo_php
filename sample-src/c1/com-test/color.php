<?php
// ライブラリの自動取り込みを利用する ------ (*1)
require_once 'vendor/autoload.php';

// ライブラリを利用することを宣言 ----- (*2)
use JakubOnderka\PhpConsoleColor\ConsoleColor;

// オブジェクト生成
$ccolor = new ConsoleColor;

// コンソールのサポート状況を確認
if (!$ccolor->isSupported()) {
  echo "カラーをサポートしていません\n"; exit;
}
if (!$ccolor->are256ColorsSupported()) {
  echo "256色モードはサポートしていません\n"; exit;
}

// ネームスペースでクラス名を記述する場合 --- (*3)
$con = new JakubOnderka\PhpConsoleColor\ConsoleColor();
// サポートしているスタイルを色々と表示
foreach ($ccolor->getPossibleStyles() as $i => $style) {
  echo "[".$ccolor->apply($style, $style)."]";
}
for ($i = 1; $i <= 255; $i++) {
  echo $con->apply("color_$i","*");
  echo $con->apply("bg_color_$i","*");
}
echo "\n";

