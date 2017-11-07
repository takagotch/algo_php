<?php
// 各種設定
$admin_password = "m9k7PZRgG8SAySmG";
$dataFile = dirname(__FILE__).'/data/userauth.dat';
$iv_a = [177,108,37,2,26,148,178,3,72,100,27,156,62,231,205, 83];
$enc_iv = implode('', array_map('chr', $iv_a));

// メイン処理 --- (*1)
$info = "";
$m = empty($_POST['m']) ? '' : $_POST['m']; 
if ($m == 'add') $info = m_add();
if ($m == 'get') $info = m_get();

// ユーザーの追加処理 --- (*2)
function m_add() {
  $userId = empty($_POST['userId']) ? '' : $_POST['userId'];
  $password = empty($_POST['password']) ? '' : $_POST['password'];
  $secret = empty($_POST['secret']) ? '' : $_POST['secret'];
  if ($userId == "" || $password == "" || $secret == "") {
    return "ユーザー情報を正しく入力してください";
  }
  putUserData([
    'userId'=>$userId, 'password'=>$password, 
    'secret'=>$secret]);
  return "保存しました";
}

// ユーザーデータを追加 --- (*3)
function putUserData($user) {
  global $dataFile, $enc_iv, $admin_password;
  // パスワードをハッシュ化 --- (*4)
  // 暗号化のために適当なsaltを生成する
  $salt = base64_encode(openssl_random_pseudo_bytes(16));
  $password = $user['password'];
  $user['password'] = hash('sha256', $password.$salt);
  $user['salt'] = $salt; // ユーザーのsaltを記録
  // 秘密メモを暗号化 --- (*5)
  $secret = openssl_encrypt(
    $user['secret'], 'aes-256-cbc',
    $password.$salt, 0, $enc_iv);
  $user['secret'] = $secret;
  // データファイルを読み出して追記
  $data = getUserData();
  $data[$user['userId']] = $user;
  $json = json_encode($data);
  print_r($data, $json);
  // データファイルへ保存 --- (*6)
  $enc = openssl_encrypt($json, 'aes-256-cbc', $admin_password, 0, $enc_iv);
  file_put_contents($dataFile, $enc);
}

// ユーザーの参照処理 --- (*7)
function m_get() {
  global $enc_iv;
  // パラメータを確認
  $userId = empty($_POST['userId']) ? '' : $_POST['userId'];
  $password = empty($_POST['password']) ? '' : $_POST['password'];
  if ($userId == "") return "入力が空です";
  // ファイルからデータを読み込む
  $data = getUserData();
  // ユーザーが存在しない
  if (!isset($data[$userId])) return "情報に誤りがあります";
  $u = $data[$userId];
  // パスワードの照合 --- (*8)
  $salt = $u['salt'];
  $pw_hash = hash('sha256', $password.$salt);
  if ($u['password'] != $pw_hash) return "情報に誤りがあります";
  $secret_raw = $u['secret'];
  $secret = openssl_decrypt($secret_raw, "aes-256-cbc",
    $password.$salt, 0, $enc_iv);
  $secret_ = htmlentities($secret);
  return "<div class='read'><h3>ユーザー認証成功</h3>".
    "<ul><li>userId: $userId</li>".
    "<li>secret: $secret_</li></ul></div>"; 
}

// ユーザーデータを取得 
function getUserData() {
  global $dataFile, $enc_iv, $admin_password;
  $data = [];
  if (file_exists($dataFile)) {
    // データを取得
    $raw = file_get_contents($dataFile);
    $json = openssl_decrypt($raw, "aes-256-cbc", 
              $admin_password, 0, $enc_iv);
    // データをデシリアライズする
    $data = json_decode($json, true);
  }
  return $data;
}
?>
<html><meta charset="utf-8">
<body><style> 
  .read { background-color: #e0e0fc; padding: 10px; } 
  form { margin-left: 10px; }
</style>
<?php echo $info; ?>
<h2>ユーザーの参照</h2>
<form method="post">
  <input type="hidden" name="m" value="get">
  userId:<br><input name="userId"><br>
  password:<br><input type="password" name="password"><br>
  <input type="submit" value="参照">
</form>

<hr><h2>ユーザーの追加</h2>
<form method="post">
  <input type="hidden" name="m" value="add">
  userId:<br><input name="userId"><br>
  password:<br><input type="password" name="password"><br>
  secret(秘密のメモ):<br><input name="secret"><br>
  <input type="submit" value="追加">
</form>
</body></html>  



