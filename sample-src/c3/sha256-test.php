<?php
$text = "目は見るゆえに, 耳は聞くゆえに幸いです";
$hash = hash("sha256", $text);
echo "入力: $text\n";
echo "ハッシュ: $hash\n";

