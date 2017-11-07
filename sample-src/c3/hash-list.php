<style> 
  td { border:1px solid silver; padding:6px; }
</style>
<?php
// 入力文字列
$input = isset($_GET["input"]) ? $_GET["input"] : "abc";
echo "<h3>入力: ".htmlentities($input)."</h3>";
// ハッシュアルゴリズム一覧を取得
$list = hash_algos();
// 各アルゴリズムで入力のハッシュを計算
echo "<table>";
foreach ($list as $algo) {
  $hash = hash($algo, $input);
  echo "<tr><td>$algo</td>";
  echo "<td>$hash</td></tr>\n";
}
echo "</table>";
?>

