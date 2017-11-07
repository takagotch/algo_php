<html><body><?php
// ビンゴマシン
session_start();

// 何ターン目からを得る
$turn = empty($_GET["turn"]) ? 0 : intval($_GET["turn"]);

// 0ターン目なら初期化する
if ($turn == 0 || empty($_SESSION["numbers"])) {
  // 1-75までの配列を作る
  $numbers = array();
  for ($i = 1; $i <= 75; $i++) {
    $numbers[$i] = $i;
  }
  // シャッフルする
  shuffle($numbers);
  // セッションに保存
  $_SESSION["numbers"] = $numbers;
}

// セッションから番号データを取り出す
$numbers = $_SESSION["numbers"];
$num = $numbers[$turn];
$now_turn = $turn + 1;
$next = ($turn + 1) % 75;

// 結果を出力する
echo "<p>{$now_turn}ターン目</p>";
echo "<h1>$num</h1>";
echo "<p><a href='bingo.php?turn=$next'>次の番号</a></p>";
?></body></html>


