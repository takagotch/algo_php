<?php
$str = "今日は晴れたので散歩に行く。";

// php-mecabで文章を解析
$mecab = new MeCab_Tagger();
$nodes = $mecab->parseToNode($str);

// 解析結果を出力
foreach ($nodes as $i) {
  $word = $i->getSurface();
  $info = $i->getFeature();
  echo "$word \t $info\n";
}

