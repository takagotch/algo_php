<?php
// 入力をチェック
$rpn = isset($_GET["rpn"]) ? $_GET["rpn"] : "1 2 3 * +";
// RPNを計算
$history = "";
$answer = calcRPN($rpn);

// RPNを計算
function calcRPN($str) {
  global $history;
  // 式をトークン(最小単位)に分割する --- (*1)
  $tokens = preg_split('#\s+#', trim($str));
  // トークンを一つずつチェックしていく---(*2)
  $stack = []; // スタックを準備
  foreach ($tokens as $t) {
    // 数値 --- (*3)
    if (preg_match('#^[0-9\.]+$#', $t)) {
      $stack[] = floatval($t);
      addHistory($stack, "$t: push");
      continue;
    }
    // 四則演算 --- (*4)
    $b = array_pop($stack);
    $a = array_pop($stack);
    switch ($t) {
      case '+': $c = ($a + $b); break;
      case '-': $c = ($a - $b); break;
      case '*': $c = ($a * $b); break;
      case '/': $c = ($a / $b); break;
      case '%': $c = ($a % $b); break;
      default:
        return "error";
    }
    $stack[] = $c;
    addHistory($stack, "$t: pop $a $b, push $c");
  }
  return array_pop($stack);
}
function addHistory($stack, $desc) {
  global $history;
  $line = "<td>$desc</td>".
          "<td>[".implode(", ", $stack)."]</td>";
  $history .= "<tr>".$line."</tr>";
}

// HTMLフォームを出力
$rpn_ = htmlentities($rpn, ENT_QUOTES);
echo <<< EOS
<!DOCTYPE html><meta charset="UTF-8">
<form>
  RPN: <input name="rpn" value="$rpn_" size="30"><br>
  <input type="submit" value="計算">
</form><hr>
<div>答え: $answer</div><hr>
<table><tr><td>操作</td><td>スタック</td></tr>
$history</table>
EOS;

