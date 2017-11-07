<?php
// ナップサックの重さ
$max_weight = 9;
// 商品の一覧
$items = [
  ["name"=>"A", "weight"=>1, "price"=>730],
  ["name"=>"B", "weight"=>2, "price"=>1470],
  ["name"=>"C", "weight"=>3, "price"=>2200],
  ["name"=>"D", "weight"=>4, "price"=>2870],
  ["name"=>"E", "weight"=>5, "price"=>3500],
];

// キロ単価を求める
foreach ($items as $i => &$it) {
  $e = $it["price"] / $it["weight"];
  $it["unit-price"] = $e;
}
// 単価順にソート
usort($items, function($a,$b) {
  return $b["unit-price"] - $a["unit-price"];
});
// 単価順にナップサックに詰める
$knapsack = "";
$total = 0; $price = 0;
foreach ($items as $i) {
  echo "-{$i['name']}の単価-{$i['unit-price']}\n";
  // 入るか？
  $space = $max_weight - $total;
  if ($i["weight"] <= $space) {
    $knapsack .= $i["name"];
    $total += $i["weight"];
    $price += $i["price"];
  }
}

echo "\n持って行く商品: $knapsack\n";
echo "価値の合計: {$price}円\n";
echo "重さの合計: {$total}kg\n";

