<?php
// JSON5のデータをデコードする
function json5_decode($json5) {
  return json5_value($json5);
}
// PHPのデータ型をJSON5にエンコード
function json5_encode($obj) {
  return json_encode($obj); // JSONにするだけ
}

// JSON5の値を一つ読む --- (*1)
function json5_value(&$json5) {
  $json5 = trim($json5);
  json5_comment($json5); // コメントがあれば読み飛ばす
  // 一文字切り出す --- (*2)
  $c = substr($json5, 0, 1);
  // Object
  if ($c == '{') {
    return json5_object($json5);
  }
  // Array
  if ($c == '[') {
    return json5_array($json5);
  }
  // 文字列
  if ($c == '"' || $c == "'") {
    return json5_string($json5);
  }
  // null / true / false
  if (strncasecmp($json5, "null", 4) == 0) {
    $json5 = substr($json5, 4);
    return null;
  }
  if (strncasecmp($json5, "true", 4) == 0) {
    $json5 = substr($json5, 4);
    return true;
  }
  if (strncasecmp($json5, "false", 5) == 0) {
    $json5 = substr($json5, 5);
    return false;
  }
  // 16進数 --- (*3)
  if (preg_match('/^(0x[a-zA-Z0-9]+)/', $json5, $m)) {
    $num = $m[1];
    $json5 = substr($json5, strlen($num));
    return intval($num, 16);
  }
  // 数値(or 指数形式の値)
  if (preg_match('/^((\+|\-)?\d*\.?\d*[eE]?(\+|\-)?\d*)/', $json5, $m)) {
    $num = $m[1];
    $json5 = substr($json5, strlen($num));
    return floatval($num);
  }
  // その他の文字は読み飛ばす
  $json5 = substr($json5, 1);  
}
// コメントを読み飛ばす処理
function json5_comment(&$json5) {
  while ($json5 != '') {
    $json5 = ltrim($json5);
    $c2 = substr($json5, 0, 2);
    // ブロックコメントの時
    if ($c2 == '/*') {
      str_token($json5, '*/');
      continue;
    }
    // ラインコメントの時
    if ($c2 == '//') {
      str_token($json5, "\n");
      continue;
    }
    break;
  }
}
// 文字列データを読む
function json5_string(&$json5) {
  // 文字列記号を取得
  $flag = substr($json5, 0, 1);
  $json5 = substr($json5, 1);
  $str = "";
  while ($json5 != "") {
    // 一文字確認
    $c = mb_substr($json5, 0, 1);
    $json5 = substr($json5, strlen($c));
    // 文字列の終端か
    if ($c == $flag) break;
    // 改行やエスケープ
    if ($c == "\\") {
      if (substr($json5, 0, 2) == "\r\n") {
        $json5 = substr($json5, 2);
        $str .= "\r\n"; continue;
      }
      if (substr($json5, 0, 1) == "\n") {
        $json5 = substr($json5, 1);
        $str .= "\n"; continue;
      }
    }
    $str .= $c;
  }
  $str = json_decode('"'.$str.'"'); // エスケープの展開など
  return $str;
}
// Array型のデータを読む --- (*4)
function json5_array(&$json5) {
  // '['を読み飛ばす
  $json5 = substr($json5, 1);
  $res = [];
  while ($json5 != '') {
    json5_comment($json5);
    // Arrayの終端か
    if (strncmp($json5, ']', 1) == 0) {
      $json5 = substr($json5, 1);
      break;
    }
    // 値を得る
    $res[] = json5_value($json5);
    // カンマを読み飛ばす
    $json5 = ltrim($json5);
    if (substr($json5, 0, 1) == ',') {
      $json5 = substr($json5, 1);
    }
  }
  return $res;
}
// Object型のデータを読む
function json5_object(&$json5) {
  // '{'を読み飛ばす
  $json5 = substr($json5, 1);
  $res = [];
  while ($json5 != '') {
    // コメントがあれば飛ばす
    json5_comment($json5);
    // Objectの終端か
    if (strncmp($json5, '}', 1) == 0) {
      $json5 = substr($json5, 1);
      break;
    }
    // キーを得る
    $c = substr($json5, 0, 1);
    if ($c == '"' || $c == "'") {
      $key = json5_string($json5);
      str_token($json5, ':');
    } else {
      $key = trim(str_token($json5, ":"));
    }
    // 値を得る
    $value = json5_value($json5);
    $res[$key] = $value;
    // カンマを読み飛ばす
    $json5 = ltrim($json5);
    if (strncmp($json5, ',', 1) == 0) {
      $json5 = substr($json5, 1);
    }
  }
  return $res;
}
// 区切り$splまで切り取る
function str_token(&$str, $spl) {
  $i = strpos($str, $spl);
  if ($i === FALSE) {
    $result = $str;
    $str = "";
    return $result;
  }
  $result = substr($str, 0, $i);
  $str = substr($str, $i+strlen($spl));
  return $result;
}

