<?php

// テスト用の関数
function test($s, $desc) {
  $d = new DateTime('2018-01-01 0:0:0');
  $d->modify($s);
  $fmt = $d->format('Y-m-d H:i:s');
  echo "| $s \t| $fmt \t| $desc\n";
}

test('-1 days', '一日前');
test('yesterday 23:00', '一日前の23時');
test('tomorrow', '一日後');
test('+8 hours', '8時間後');
test('first day of February', '2月の最初の日');
test('last day of this month', 'その月の最終日');
test('second sat of January', '1月の第二土曜日');
test('+3 weeks','3週間後');
test('Wed', '次の水曜日');
test('Tue next week','次週の火曜日');

