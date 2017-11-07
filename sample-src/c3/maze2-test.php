<html><head><style> 
 .wall { background-color: black; color: gray; }
 .road { background-color: white; color: white; }
 pre { padding:12px; font-size:10px; line-height:10px; }
</style></head><body><pre>
<?php
// 迷路を作成して結果を出力する
$maze = generateMaze(55, 55);
echo drawMaze($maze);

// 穴掘り法により、迷路を作成する関数
function generateMaze($width = 55, $height = 55) {
  // 必ず奇数になるようにする
  $width = floor($width / 2) * 2 + 1;
  $height = floor($height / 2) * 2 + 1;
  // 迷路を初期化
  $maze = array();
  // 全てを壁で埋める
  for ($y = 0; $y < $height; $y++) {
    $maze[$y] = array();
    for ($x = 0; $x < $width; $x++) {
      $maze[$y][$x] = 1;
    }
  }
  // 基準点を決める
  $dx = floor(mt_rand(1, $width-2) / 2) * 2 + 1;
  $dy = floor(mt_rand(1, $height-2) / 2) * 2 + 1;
  $maze[$dy][$dx] = 0; // 基準点を通路とする
  return digMaze($maze, $dx, $dy, $width, $height);
}

// 再帰的に穴を掘る
function digMaze(&$maze, $x, $y, $width, $height) {
  // どちらの方向を掘るか座標テーブルを作る
  // 上下左右を表すテーブルをシャッフル
  $UDLR = [[0,-1],[0,1],[-1,0],[1,0]];
  //mt_shuffle($UDLR);
  // 四方向を適当な順番にチェックしていく
  for ($i = 0; $i < 4; $i++) {
    $dir = $UDLR[$i];
    // 2マス先を調べる
    $x2 = $dir[0] * 2 + $x;
    $y2 = $dir[1] * 2 + $y;
    // 迷路の外なら中止
    if ($x2 < 0 || $y2 < 0 ||
        $x2 >= $width-1 ||
        $y2 >= $height-1) continue;
    // 既に通路なら中止
    if ($maze[$y2][$x2] == 0) continue;
    // 2マス穴を掘る
    $maze[$y + $dir[1]][$x + $dir[0]] = 0;
    $maze[$y2][$x2] = 0;
    // 再帰的に穴を掘る
    digMaze($maze, $x2, $y2, $width, $height);
  }
  return $maze;
}

// mt_rand()を使った配列のシャッフル関数
function mt_shuffle(&$a) {
  $a = array_values($a);
  for ($i = count($a) - 1; $i >= 1; $i--) {
    $r = mt_rand(0, $i);
    list($a[$i], $a[$r]) = array($a[$r], $a[$i]);
  }
}

// 迷路を描画する
function drawMaze($maze) {
  $pat = array();
  $pat[0] = "<span class='road'>0,</span>"; // 通路
  $pat[1] = "<span class='wall'>1,</span>"; // 壁
  $html = "";
  for ($y = 0; $y < count($maze); $y++) {
    for ($x = 0; $x < count($maze); $x++) {
      $html .= $pat[$maze[$y][$x]];
    }
    $html .= "\n";
  }
  return $html;
}

