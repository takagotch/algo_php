<?php
$ranking = file_get_contents('wagahai-rank1000.txt');
$rank_list = explode("\n", $ranking);

$char_txt = file_get_contents("wagahai-list.txt");
$char_list = explode(",", $char_txt);

$res = [];
foreach ($char_list as $char) {
  $char = trim($char);
  foreach ($rank_list as $row) {
    if (strpos($row, $char) !== false) {
      $res[] = $row;
    }
  }
}

sort($res);
echo implode("\n", $res);
echo "ok\n";

