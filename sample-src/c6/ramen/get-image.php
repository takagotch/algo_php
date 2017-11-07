<?php
require_once 'phpflickr/phpFlickr.php';
// 以下のFlickr APIを書き換えてください。
define('API_KEY', 'a7f2d9248a95ddc5af4eff3b41f14564');
define('API_SECRET', 'e69c982fe007e4ec');

download_flickr('塩ラーメン', 'sio');
download_flickr('味噌ラーメン', 'miso');

function download_flickr($keyword, $dir) {
  // 保存先ディレクトリを生成
  if (!file_exists($dir)) mkdir($dir);
  // phpFlickrのオブジェクトを生成
  $flickr = new phpFlickr(API_KEY, API_SECRET);
  // 写真を検索
  $search_opt = [
    'text' => $keyword,
    'media' => 'photos',     // 動画ではなく画像を指定
    'license'=> '4,5,6,7,8', // 一応商用利用可能なCCライセンスを指定
    'per_page' => 200,       // 何枚欲しいか
    'sort' => 'relevant',    // キーワードの関連順に
  ];
  $result = $flickr->photos_search($search_opt);
  if (!$result) die("Flickr API error");
  // 各写真をダウンロード
  foreach ($result['photo'] as $photo) {
    // 情報から写真のURLを得る
    $farm = $photo['farm'];
    $server = $photo['server'];
    $id = $photo['id'];
    $secret = $photo['secret'];
    $url = "http://farm{$farm}.staticflickr.com/{$server}/{$id}_{$secret}.jpg";
    echo "get $id : $url\n";
    $savepath = "./$dir/$id.jpg";
    if (file_exists($savepath)) continue;
    // ダウンロードと保存
    $bin = file_get_contents($url);
    file_put_contents($savepath, $bin);
  }
}



