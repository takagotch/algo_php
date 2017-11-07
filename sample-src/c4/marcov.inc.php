<?php
// --- マルコフ連鎖で作文するライブラリ

// 形態素解析のためのライブラリを取り込む
require_once 'mecab.inc.php'; 

// マルコフ連鎖で作文する
function marcov_gen($text, $count) {
  // 形態素解析
  $wlist = mecab_parse_simple($text);
  // マルコフ連鎖のための辞書を作成
  $dic = make_dic($wlist);
  // 辞書を元に作文する
  return make_sentence($dic, $count);
}

// 辞書を作成
function make_dic($wlist) {
  $tmp = ["@"];
  $dic = [];
  foreach ($wlist as $w) {
    if ($w == "" || $w == "EOS") continue;
    $tmp[] = $w;
    if (count($tmp) < 3) continue;
    if (count($tmp) > 3) array_shift($tmp);
    set_word($dic, $tmp);
    if ($w == "。") {
      $tmp = ["@"]; continue;
    }
  }
  return $dic;
}

// 辞書に単語を登録
function set_word(&$dic, $tmp) {
  $w1 = $tmp[0];
  $w2 = $tmp[1];
  $w3 = $tmp[2];
  if (empty($dic[$w1])) $dic[$w1] = [];
  if (empty($dic[$w1][$w2])) $dic[$w1][$w2] = [];
  if (empty($dic[$w1][$w2][$w3])) $dic[$w1][$w2][$w3] = 0;
  $dic[$w1][$w2][$w3]++;
}

// 辞書から作文する
function make_sentence($dic, $count) {
  $ret = [];
  for ($i = 0; $i < $count; $i++) {
    $top = $dic["@"];
    if (!$top) break;
    $w1 = choice_word($top);
    $w2 = choice_word($top[$w1]);
    $ret[] = $w1;
    $ret[] = $w2;
    for (;;) {
      $w3 = choice_word($dic[$w1][$w2]);
      $ret[] = $w3;
      if ($w3 == "。") break;
      $w1 = $w2;
      $w2 = $w3;
    }
  }
  return implode("", $ret);
}

// 複数のキーから一つをランダムに選ぶ
function choice_word($o) {
  if (!is_array($o)) return "。";
  $ks = array_keys($o);
  return $ks[mt_rand(0, count($ks)-1)];
}

