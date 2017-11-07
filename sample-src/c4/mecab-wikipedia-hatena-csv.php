<?php
// Wikipediaの見出し語一覧を処理
$wp = file_get_contents("jawiki-latest-all-titles-in-ns0");
mecab_dic_conv($wp,"wikipedia");

// はてなキーワードを処理
$hk = file_get_contents("keywordlist_furigana.csv");
$hk = mb_convert_encoding($hk, "utf-8", "euc-jp, utf-8, auto");
mecab_dic_conv($hk, "hatena");

// 変換
function mecab_dic_conv($text, $org) {
  echo "--- $org ---\n";
  $fp = fopen("./$org-list.csv", "w");
  // 分割する
  $lines = preg_split('/[\r\n]+/', $text);
  $res = [];
  foreach ($lines as $li) {
    $li = trim($li);
    if ($li == "") continue;
    $len = mb_strlen($li);
    // 不要キーワードを排除
    if ($len < 3 || $len > 10) continue;
    if (strpos($li, '曖昧さ回避') !== FALSE) continue;
    if (strpos($li, 'の登場人物') !== FALSE) continue;
    if (strpos($li, '一覧') !== FALSE) continue;
    if (strpos($li, 'PJ:') === 0) continue;
    if (preg_match('/[\/\$\%\+\&\#\"\'\*\!\(\)\,〜（）]/u',$li)) continue;
    if (preg_match('/^[0-9\.\-]+$/',$li)) continue;
    if (preg_match('/^(\d{4}|\-|\.)/',$li)) continue;
    if (preg_match('/^.+月.+日$/',$li)) continue;
    $li = str_replace('_', ' ', $li);
    // MeCab辞書用CSVを作成
    $cs = explode("\t", $li);
    if (count($cs) == 2) {
      $kana = $cs[0];
      $key = $cs[1];
    } else {
      $kana = "*";
      $key = $cs[0];
    }
    $key  = trim($key);
    $kana = trim($kana);
    $cost = max(-36000, -400 * mb_strlen($key));
    $ls = [$key,'','',$cost,'名詞','一般','*','*','*','*','*',$kana,'*',$org];
    $ln = implode(',', $ls);
    // echo $ln."\n";
    fwrite($fp, $ln."\n");
  }
  fclose($fp);
}


