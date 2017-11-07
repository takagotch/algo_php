<?php
require 'vendor/autoload.php';
use Goutte\Client;

$top_page_url = "http://uta.pw/sakusibbs/";
$user_id = 'JS-TESTER';
$password = 'ipCU12ySxI';

// トップページにアクセス --- (*1)
$client = new Client();
$crawler = $client->request('GET',$top_page_url);
echo "トップページを取得しました\n";

// ログインページを表示 --- (*2)
$link = $crawler->selectLink('ログイン')->link();
$crawler = $client->click($link); // --- (*3)
echo "ログインページを取得しました\n";

// フォームにユーザー名とパスワードをセットして送信 --- (*4)
$form = $crawler->selectButton('ログイン')->form();
$crawler = $client->submit($form, array(
  'username_mmlbbs6' => $user_id,
  'password_mmlbbs6' => $password)); // --- (*5)

// ログインしたら、マイページのリンクを探す --- (*6)
//   → [(ユーザー名)さんのマイページ]と表示されている
$mypage_url = "";
$crawler->filter('a')->each( // --- (*7)
  function($e)use(&$mypage_url) {
    $label = $e->text();
    if (strpos($label, 'のマイページ') !== FALSE) {
      $mypage_url = $e->extract(array('href'))[0];
    }
  });
if ($mypage_url == "") {
  echo 'NG:ログインできていません。'; exit;
}
echo "ログインしました。マイページにアクセスします。\n";

// マイページにアクセスする --- (*8)
$crawler = $client->request('GET', $mypage_url);
$favlist = [];
$crawler->filter('ul#favlist > li')->each(
  function($e) use (&$favlist){
    $a = $e->filter('a');
    $text = $a->text();
    $link = $a->extract(array('href'))[0];
    $favlist[] = "$text,$link";
  });
// 結果を表示する
echo "----\n結果を表示:\n";
echo implode("\r\n", $favlist)."\n";


