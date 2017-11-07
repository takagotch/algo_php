<html><body><?php
// --- ランダムにパスワードを生成するプログラム(問題あり)
// パスワードに使っても良い文字の一覧
$PASSWORD_CHARS = 
  'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.
  'abcdefghijklmnopqrstuvwxyz'.
  '0123456789_-#!$';

// 任意文字列のパスワードを生成
function password_gen($length) {
  global $PASSWORD_CHARS;
  $result = "";
  for ($i = 0; $i < $length; $i++) {
    $r = rand(0, strlen($PASSWORD_CHARS) - 1);
    $result .= substr($PASSWORD_CHARS, $r, 1);
  }
  return $result;
} 

// 複数の候補を作成
for ($i = 1; $i <= 30; $i++) {
  echo password_gen(12)."<br>\n";
}

