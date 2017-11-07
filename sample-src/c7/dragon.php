<?php
// ドラゴン曲線を描画
require_once 'turtle.inc.php';

// パラメータを変えて三つのドラゴン曲線を出力
$params = [
  1=>["pos"=>[550,700], "i"=>5, "w"=>80],
  2=>["pos"=>[400,250], "i"=>10,"w"=>19],
  3=>["pos"=>[550,765], "i"=>14,"w"=>5],
];
foreach ($params as $n => $p) {
  drawCanvas(1000,1000, "dragon{$n}.png",
    function () use ($p) {
      move($p["pos"][0], $p["pos"][1]);
      dragon($p['i'], $p['w'], 90);
    });
}

function dragon($i, $w, $angle) {
  if ($i <= 0) {
    forward($w); return;
  }
  dragon($i-1, $w, 90);
  turn($angle);
  dragon($i-1, $w, -90);
}

