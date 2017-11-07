<?php
// --- ランダムにパスワードを生成するプログラム(修正版)

// パスワードに使っても良い文字の一覧
$PASSWORD_CHARS = 
  'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.
  'abcdefghijklmnopqrstuvwxyz'.
  '0123456789_-#!$';

// 任意文字列のパスワードを生成
function password_gen($length) {
  global $PASSWORD_CHARS;
  // パスワードに適したランダムなバイト列を得る
  $bytes = openssl_random_pseudo_bytes($length);
  $chars_len = strlen($PASSWORD_CHARS);
  $result = "";
  for ($i = 0; $i < $length; $i++) {
    $r = ord(substr($bytes, $i, 1)) % $chars_len;
    $result .= substr($PASSWORD_CHARS, $r, 1);
  }
  return $result;
} 

// 複数の候補を作成
$res = "";
$len = intval(empty($_GET["len"]) ? 12 : $_GET["len"]);
if ($len == 0) $len = 12;
for ($i = 1; $i <= 30; $i++) {
  $res .= password_gen($len)."\n";
}
?>
<html><body bgcolor="#f0f0f0">
<form>
  文字数:<input name="len" value="12">
  <input type="submit" value="生成">
</form>
パスワード候補:<br>
<textarea rows="20" cols="20"><?php echo $res ?></textarea>
</body></html>

