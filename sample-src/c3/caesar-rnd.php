<meta charset="UTF-8">
<?php
// パラメータの取得
$str = isset($_GET["str"]) ? strtoupper($_GET["str"]) : "";
$key = isset($_GET["key"]) ? intval($_GET["key"]) : 3;
$enc = isset($_GET["enc"]) ? $_GET["enc"] : "enc";
if ($str != "") convert($str, $key, $enc);
$str_ = htmlentities($str, ENT_QUOTES);
$enc_ = ($enc == "enc") ? "checked" : "";
$dec_ = ($enc == "dec") ? "checked" : "";
// フォームの表示
echo <<< EOS
<form>
  文字列: <input name="str" value="$str_"><br>
  鍵　　: <input name="key" value="$key"><br>
  <input name="enc" type="radio" value="enc" $enc_>暗号化
  <input name="enc" type="radio" value="dec" $dec_>復号化<br>
  <input type="submit" value="変換">
</form>
EOS;
// 暗号の変換テーブル生成---(*1)
function makeTable($key, $enc) {
  $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $char_a = str_split($chars);
  $char_b = str_split($chars);
  mt_srand($key); // 乱数を初期化
  mt_shuffle($char_b);
  $table = [];
  if ($enc) {
    foreach ($char_a as $i => $c) {
      $table[$c] = $char_b[$i];
    }
  } else {
    foreach ($char_b as $i => $c) {
      $table[$c] = $char_a[$i];
    }
  }
  return $table;
}
function mt_shuffle(&$a) {
  $a = array_values($a);
  for ($i = count($a) - 1; $i >= 1; $i--) {
    $r = mt_rand(0, $i);
    list($a[$i], $a[$r]) = array($a[$r], $a[$i]);
  }
}

// 変換を行う---(*2)
function convert($str, $key, $enc) {
  if (empty($_GET["str"])) return;
  $table = makeTable($key, ($enc=='enc'));
  $res = "";
  for ($i = 0; $i < strlen($str); $i++) {
    $c = substr($str, $i, 1);
    $res .= isset($table[$c]) ? $table[$c] : $c; 
  }
  $str = htmlentities($str, ENT_QUOTES);
  $res = htmlentities($res, ENT_QUOTES);
  $t1 = $t2 = "";
  foreach ($table as $k => $v) { $t1 .= "|$k"; $t2 .= "|$v"; }
  echo "<div>変換テーブル: <br>$t1<br>$t2</div>";
  echo "<div>変換前: $str</div>"; 
  echo "<div>変換後: $res</div><hr>"; 
}




