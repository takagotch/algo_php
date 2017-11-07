<meta charset="UTF-8">
<?php
// パラメータの取得
$str = isset($_GET["str"]) ? strtoupper($_GET["str"]) : "";
$shift = isset($_GET["shift"]) ? intval($_GET["shift"]) : 3;
if ($str != "") convert($str, $shift);
$str_ = htmlentities($str, ENT_QUOTES);
// フォームの表示
echo <<< EOS
<form>
  文字列: <input name="str" value="$str_"><br>
  シフト: <input name="shift" value="$shift"><br>
  <input type="submit" value="変換">
</form>
EOS;
// シーザー暗号の変換テーブル生成---(*1)
function makeTable($shift) {
  $ch1 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $shift = $shift % strlen($ch1);
  $ch2 = substr($ch1, $shift).substr($ch1, 0, $shift);
  $table = [];  
  for ($i = 0; $i < strlen($ch1); $i++) {
    $c1 = substr($ch1, $i, 1);
    $c2 = substr($ch2, $i, 1);
    $table[$c2] = $c1;
  }
  return $table;
}
// 変換を行う---(*2)
function convert($str, $shift) {
  if (empty($_GET["str"])) return;
  $table = makeTable($shift);
  $res = "";
  for ($i = 0; $i < strlen($str); $i++) {
    $c = substr($str, $i, 1);
    $res .= isset($table[$c]) ? $table[$c] : $c; 
  }
  $str = htmlentities($str, ENT_QUOTES);
  $res = htmlentities($res, ENT_QUOTES);
  echo "<div>変換前: $str</div>"; 
  echo "<div>変換後: $res</div><hr>"; 
}




