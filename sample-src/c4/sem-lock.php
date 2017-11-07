<?php
// セマフォを取得
$sem_id = sem_get(8039);
sem_acquire($sem_id);

// ここで何か処理
echo "処理開始\n";
sleep(5);
echo "処理終了\n";

// セマフォを解放
sem_release($sem_id);

