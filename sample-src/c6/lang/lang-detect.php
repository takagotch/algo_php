<html><meta charset="utf-8"><body><?php
// フォームからの入力を得る
$text = empty($_POST['text']) ? "" : $_POST['text'];
$result = "";
if ($text != '') {
  // 言語を判定する
  $data = count_text($text);
  $ann = fann_create_from_file('./lang.net');
  $r = fann_run($ann, $data);
  $i = array_max_index($r);
  $lang_list = ['英語', 'タガログ語', 'インドネシア語'];
  $result = "<h3>".$lang_list[$i]."でしょう！</h3><ul>";
  foreach ($r as $i => $v) {
    $result .= "<li>".$lang_list[$i].":".floor($v*100)."%</li>";
  }
  $result .= "</ul>";
}
$text_enc = htmlspecialchars($text);
// 配列で値が最大のインデックスを返す
function array_max_index($a) {
  $mv = -1; $mi = -1;
  foreach ($a as $i => $v) {
    if ($mv < $v) {
      $mv = $v; $mi = $i;
    }
  }
  return $mi;
}
// アルファベットの個数を数える
function count_text($text) {
  $text = strtolower($text);
  $text = str_replace(" ", '', $text);
  $cnt = array_fill(0, 26, 0);
  for ($i = 0; $i < strlen($text); $i++) {
    $c = ord(substr($text, $i, 1));
    if (97 <= $c && $c <= 122) {
      $c -= 97;
      $cnt[$c]++;
    }
  }
  return $cnt;
}
?>
<h1>三カ国語の言語判定</h1>
<form method="post">
  <textarea name="text" rows=5 cols=60><?php echo $text_enc ?>
  </textarea><br>
  <input type="submit" value="言語の判定">
</form>
<div><?php echo $result ?></div>




