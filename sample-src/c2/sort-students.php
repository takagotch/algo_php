<?php
// 学生のテストデータ
$data = [
  ['name'=>'Arai', 'score'=>30],
  ['name'=>'Inoue', 'score'=>40],
  ['name'=>'Utada', 'score'=>30],
  ['name'=>'Okuda', 'score'=>40],
  ['name'=>'Kato', 'score'=>23]
];
// 名簿順を維持したまま点数順に並び替え
// 元の並び順を記録 --- (*1)
for ($i = 0; $i < count($data); $i++) {
  $data[$i]["id"] = $i + 1;
}
// ソート --- (*2)
usort($data, function($a, $b) {
  if ($a['score'] == $b['score']) {
    return ($a['id'] > $b['id']) ? 1 : -1;
  }
  return ($a['score'] < $b['score']) ? 1 : -1;
});
// 結果表示
foreach ($data as $u) {
  echo $u['id'].":".$u['name'].":".$u['score']."\n";
}

