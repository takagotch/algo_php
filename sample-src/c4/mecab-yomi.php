<?php

require 'mecab.inc.php';

$input = <<< EOS
喜びに満ちた心は治療薬として良く効き、
打ちひしがれた霊は骨を枯らす。
EOS;

// MeCabを実行
$res = mecab_parse($input);

// 結果をフリガナっぽく表示
$bun = "";
foreach ($res as $v) {
  $word = $v[0];
  // ひらがなだけならカナは不要
  if (preg_match('/^[ぁ-ゞ]+$/', $word)) {
    $bun .= $word; continue;
  }
  // 改行や句読点
  if ($word == 'EOS') continue;
  if (strpos(",.、。", $word)!==false) {
    $bun .= $word; continue;
  }
  // フリガナを追加
  $yomi = isset($v[4]) ? $v[8] : "";
  $yomi = mb_convert_kana($yomi, "c"); // ひらがな変換
  $bun .= "<ruby>$word<rt>$yomi</rt></ruby>";
}

// HTMLとして出力
echo <<< HTML
<html><body>$bun</body></html>
HTML;
 
