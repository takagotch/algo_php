<html><body>
<style>
  .cal td { border-bottom: 1px solid silver; padding: 4px; }
  .cur { font-size: 14px; color: black;  }
  .oth { font-size: 9px; color: silver; }
  .sat { color: blue; }
  .sun { color: red; }
</style>
<?php
// カレンダーの描画
echo make_calendar(2018,2);

function make_calendar($year, $month) {
  // 月初めをセット
  $t = new DateTime();
  $t->setDate($year, $month, 1);
  // その週の月曜日（カレンダー左上の日）を得る
  $t->modify("Mon this week");
  // 月終わりをセット
  $end_t = new DateTime();
  $end_t->setDate($year, $month, 1);
  $end_t->modify("last day of this month");
  // その週の日曜日(カレンダーの右下の日）を得る
  $end_t->modify("Sun");
  // タイトル
  $html = "<p>{$year}年 {$month}月</p>";
  // カレンダーをテーブルで作る
  $html .= "<table class='cal'>";
  for (;;) {
    $d = $t->format("d"); // 日を得る
    $w = $t->format("w"); // 曜日を得る
    // 日付の装飾クラスを決定
    $c_week = ($w == 0) ? "sun" : (($w == 6) ? "sat" : "");
    $c_mon = ((int)$t->format("m") == $month) ? 'cur' : 'oth';
    if ($w == 1) { // 月曜日なら行頭
      $html .= "<tr>";
    }
    $html .= "<td class='$c_mon $c_week'>$d</td>";
    if ($w == 0) { // 日曜日なら行末
      $html .= "</tr>";
    }
    // カレンダー右下に達した終わり
    $diff = $end_t->diff($t);
    if ($diff->days == 0) break;
    // 一日分進める
    $t->modify("+1 days");
  }
  $html .= "</table>";
  return $html;
}
?></body></html>


