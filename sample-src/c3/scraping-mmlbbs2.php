<?php
// Composerのオートロードを有効にする --- (*1)
require 'vendor/autoload.php';
// 対象URL
$url = "http://oto.chu.jp/mmlbbs6/index.php?action=fav_memory";
// Goutte\Clientの生成 --- (*2)
$client = new Goutte\Client();
// Webから取得 --- (*3)
$crawler = $client->request('GET', $url);
// CSSセレクタを指定して要素を取り出す --- (*4)
$crawler->filter('table tr')->each(function($e) {
  // <tr>を見つけるたびに実行される部分 --- (*5)
  $td = $e->filter('td');
  $count  = $td->eq(0)->text(); // ---- (*6)
  $title  = $td->eq(1)->text();
  $link   = "";
  $o = $td->eq(1)->filter('a')->extract(array('href')); // --- (*7)
  if ($o) { $link = $o[0]; }
  $author = $td->eq(2)->text();
  echo "$title,$author,$link\n";
});

