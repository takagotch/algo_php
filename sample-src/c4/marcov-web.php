<?php
// マルコフ連鎖で文章の要約(ブラウザ版)
require 'marcov.inc.php'; 
// フォームの値を処理
$text = isset($_POST["text"]) ? $_POST["text"] : "";
$text = trim($text);

// マルコフ連鎖で作文
if ($text != "") {
  $mcv = marcov_gen($text, 1);
} else $mcv = "...";

echo <<< END_OF_HTML
<!DOCTYPE html><html><head><meta charset="UTF-8"></head>
<body><h1>マルコフ連鎖</h1>
<form method="POST">
<p><textarea name="text" cols="60" rows="8">$text</textarea></p>
<p><input type="submit" value="マルコフ要約"></p>
<h3>結果:</h3>
<p style="padding:12px; border:1px dashed gray">$mcv</p>
</form></body></html>
END_OF_HTML;

