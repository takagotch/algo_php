<?php
require 'mecab.inc.php';

// ファイルを読み込む
$txt = file_get_contents("wagahaiwa_nekodearu.txt");
$txt = mb_convert_encoding($txt, "utf-8", "sjis");
$txt_a = explode("\r\n", $txt); // 改行で分割

// 各行をカウントする
$list = [];
foreach ($txt_a as $line) {
  countWord($line);
}

// 集計する
arsort($list);
$rank = array_slice($list, 0, 1000);
$no = 1;
foreach ($rank as $key => $val) {
  echo "({$no}位) [$key:$val]\n";
  $no++;
}
echo "\n";

// 形態素解析して単語をカウントする
function countWord($line) {
  global $list;
  // MeCabでパースする
  $mecab_res = mecab_parse($line, "-b 65536 --userdic=wagahai-list.dic");
  // 単語をカウントする
  foreach ($mecab_res as $a) {
    $word = $a[0];
    $h = isset($a[1]) ? $a[1] : "";
    // 品詞を確認
    if ($h != "名詞" && $h != "動詞" && $h != "形容詞") continue;
    // 動詞/形容詞なら言い切り系を使う
    if ($h == "動詞" || $h == "形容詞") {
      if (isset($a[7]) && $a[7] != "*") {
        $word = $a[7];
      }
    }
    if (empty($list[$word])) {
      $list[$word] = 1;
      continue;
    }
    $list[$word]++;
  }
}

