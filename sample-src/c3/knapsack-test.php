<?php
$limit_weight = 9;
$products = [
  "A"=>["weight"=>1, "price"=>730],
  "B"=>["weight"=>2, "price"=>1470],
  "C"=>["weight"=>3, "price"=>2200],
  "D"=>["weight"=>4, "price"=>2870],
  "E"=>["weight"=>5, "price"=>3500],
];

// 全ての組み合わせを作る
$result = [];
f_search(0, 0, false, "");

// 最適解を見つける(ソートするだけ)
asort($result, SORT_NUMERIC);
$result = array_reverse($result);

// 最適解を表示
$max = 0;
echo "count=".count($result)."\n";
foreach ($result as $key => $val) {
  if ($max == 0) $max = $val;
  if ($val < $max) break;
  echo "$key=$val\n";
}

function f_search($weight, $price, $pro, $knapsack) {
  global $products, $limit_weight, $result;
  
  if ($pro !== false) {
    $item = $products[$pro];
    $w = $weight + $item["weight"];
    if ($w > $limit_weight) { // 末端に達した
      knapsack_sort($knapsack);
      $result[$knapsack] = $price;
      return false;
    }
    $weight = $w;
    $price += $item["price"];
    $knapsack .= $pro;
  }
  
  // 再帰的に探索
  foreach ($products as $key => $pro) {
    f_search($weight, $price, $key, $knapsack);
  }
}

function knapsack_sort(&$knapsack) {
  $a = str_split($knapsack);
  sort($a);
  $knapsack = implode("", $a);
}


