<?php
session_start();

// ユーザーからの入力を取得
$input = isset($_GET['input']) ? $_GET['input'] : "";

// CAPTCHAと入力フォームのタグを定義
$captcha = "<img src='genImage.php'>";
$msg = "5文字のひらがなを入力してください。";
$form = <<< END_OF_FORM
<form method="GET">
  <input type="text" name="input">
  <input type="submit" value="OK">
</form>
END_OF_FORM;

// CAPTCHAのコードが入力されたときの処理
if (isset($_SESSION["CAPTCHA"]) && $_SESSION["CAPTCHA"] === $input) {
  // 正解のとき
  $msg = "<h3>正解です！</h3><a href='form.php'>もう一度試す</a>";
  $captcha = $form = "-"; // CAPTCHAやフォームを表示しない
} else {
  if ($input != "") {
    $msg = "間違い！もう一度、{$msg}";
  }
}

// HTMLを出力
echo <<< END_OF_HTML
<html><head><meta charset="UTF-8"></head>
<body>
  <h1>CAPTCHAのテスト</h1>
  <p>$captcha</p>
  <p>$msg</p>
  <p>$form</p>
END_OF_HTML;


