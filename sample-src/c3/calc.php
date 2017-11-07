<?php
// 入力をチェック
$inp = isset($_GET["inp"]) ? $_GET["inp"] : "(1+2)*(3+4)";
// 計算
$answer = calcInfix($inp);

// 計算
function calcInfix($str) {
  global $input_str;
  $input_str = $str;
  // メイン処理
  return plus_minus();
}
// 足す・引くを計算する
function plus_minus() {
  $v = mul_div();
  while(peek() == "+" || peek() == "-") {
    $op = get();
    if ($op == "+") $v += mul_div();
    if ($op == "-") $v -= mul_div();
  }
  return $v;
}
// 掛ける・割るを計算する
function mul_div() {
  $v = paren();
  while(peek() == "*" || peek() == "/") {
    $op = get();
    if ($op == "*") $v *= paren();
    if ($op == "/") $v /= paren();
  }
  return $v;
}
// カッコを計算する
function paren() {
  $v = get();
  if ($v == '(') {
    $v = plus_minus();
    $t = get();
    if ($t != ")") throw new Exception("カッコ未対応");
  }
  return $v;
}

// トークンを切り出す
function get() {
  global $input_str;
  $input_str = ltrim($input_str);
  $c = substr($input_str, 0, 1);
  if (strpos("+-*/()", $c) !== false) {
    $input_str = substr($input_str, 1);
    return $c;
  }
  if (preg_match('#^([0-9]+)#', $input_str, $m)) {
    $input_str = substr($input_str, strlen($m[1]));
    return intval($m[1]);
  }
}
// 切り出したトークンを戻す
function unget($t) {
  global $input_str;
  $input_str = $t . $input_str;
}
// 先頭のトークンを調べる
function peek() {
  $c = get();
  unget($c);
  return $c;
}

// HTMLフォームを出力
$inp_ = htmlentities($inp, ENT_QUOTES);
echo <<< EOS
<!DOCTYPE html><meta charset="UTF-8">
<form>
  式: <input name="inp" value="$inp_" size="30">
  <input type="submit" value="計算">
</form><hr>
<div>答え: $answer</div>
EOS;

