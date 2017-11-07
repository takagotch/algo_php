<?php
$str = "(1 + 2) * 3";
$res = calc_str2($str);
echo $res."\n";

function calc_str2($str) {
  // --- 中置記法を後置記法に変換 ---
  $stack = [];
  $polish = [];
  while ($str != "") { // --- (*1)
    $t = get($str); // --- (*2) 式から因子を一つ取り出す
    if ($t == '(') { // --- (*3)
      $stack[] = $t;
      continue;
    }
    if ($t == ')') { // --- (*4)
      while (count($stack) > 0) {
        $s_top = array_pop($stack);
        if ($s_top == '(') break;
        $polish[] = $s_top;
      }
      continue;
    }
    while (count($stack) > 0) { // --- (*5)優先順位を見て移動
      $s_top = $stack[count($stack)-1];
      if (priority($t) > priority($s_top)) break;
      $polish[] = array_pop($stack);
    }
    $stack[] = $t; // --- (*6)
  }
  // (*7) 残った因子を積み替える
  while(count($stack) > 0) $polish[] = array_pop($stack);
  // 逆ポーランドに変換済みの内容を出力
  echo "[".implode(" ", $polish)."]\n";

  // --- 逆ポーランドの式を計算 ---
  foreach ($polish as $t) {
    if (preg_match('#^\d+$#', $t)) {
      $stack[] = intval($t); continue;
    }
    $b = array_pop($stack);
    $a = array_pop($stack);
    switch ($t) {
      case '+': $c = $a + $b; break;
      case '-': $c = $a - $b; break;
      case '*': $c = $a * $b; break;
      case '/': $c = $a / $b; break;
      default: throw new Exception("未知の文字:$t");
    }
    $stack[] = $c;
  }
  return array_pop($stack);
}
// 演算子の優先順位を取得する関数
function priority($c) {
  $pri = ['num'=>3, '*'=>2, '/'=>2, '+'=>1, '-'=>1, '('=>0];
  return isset($pri[$c]) ? $pri[$c] : $pri['num'];
}
// トークンを切り出す
function get(&$str) {
  $str = trim($str);
  $c = substr($str, 0, 1);
  if (strpos("()+-*/", $c) !== false) {
    $str = substr($str, 1);
    return $c;
  }
  if (preg_match('#^(\d+)#', $str, $m)) {
    $str = substr($str, strlen($m[1]));
    return $m[1];
  }
  throw new Exception("未知の文字: $c");
}


