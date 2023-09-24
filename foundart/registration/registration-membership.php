<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Language" content="ja">
<title>FOUND ART / TOP</title>
<link href="account.css" rel="stylesheet" type="text/css" />
<link href="../basic-structure.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
</head>
<header>
  <h1 class="title"><a href="../index.php">FOUND ART</a></h1>
    <nav class="nav">
      <ul class="menu-group">
          <li class="menu-item"><a href="../user-artist/exhibition/list.php">EXHIBITIONS</a></li>
          <li class="menu-item"><a href="../user-artist/feed/list.php">FEEDS</a></li>
          <li class="menu-item"><a href="#">COLUMN</a></li>
      </ul>
    </nav>
    <?php

session_start();

if (isset($_GET["logout"])) {
   session_destroy();
   header("Location: registration/login.php");
    exit();
}

if (isset($_SESSION["member_id"])) {
   
    echo '<a href="?logout=1" class="login">ログアウト</a>';
} else {
   
    echo '<a href="login.php" class="login">ログイン</a>';
}
?>

</header>

<?php
// データベース接続情報
$host = "localhost";
$username = "root";
$password = "";
$dbname = "foundart"; 

// データベースに接続
$conn = new mysqli($host, $username, $password, $dbname);

// 接続エラーをチェック
if ($conn->connect_error) {
    die("接続エラー: " . $conn->connect_error);
}

// POSTリクエストを処理してデータベースに追加
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 入力値の取得
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordConfirm = $_POST["password-confirm"];

    // メールアドレスの重複チェック
    $check_sql = "SELECT * FROM registration_membership WHERE email = '$email'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // すでに登録済みのメールアドレスの場合
        header("Location: registration-membership.php");
        exit();
    } else {
        // パスワードとパスワード確認が一致するかを確認
        if ($password !== $passwordConfirm) {
            echo "パスワードが一致しません。";
        } else {
            // パスワードをハッシュ化
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // ランダムなIDを生成
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $member_id = '';
            $length = 20;

            for ($i = 0; $i < $length; $i++) {
                $member_id .= $characters[rand(0, strlen($characters) - 1)];
            }

            // SQLクエリを作成してデータを挿入
            $sql = "INSERT INTO registration_membership (member_id, email, password) VALUES ('$member_id', '$email', '$hashedPassword')";

            // フォーム処理が成功した場合
          if ($conn->query($sql) === TRUE) {
            // member_idをセッションに保存
            $_SESSION["member_id"] = $member_id;

            // 登録が成功した場合
            header("Location: ../user-artist/artist/form/new-artist-input.php");
            exit();
          } else {
            echo "エラー: " . $conn->error;
          }

            
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>User Registration</title>
</head>
<body>
  <div class="page-grid">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="form-container">
      <h3>ユーザー登録フォーム</h3>
        <div class="form-row large-row">
          <label for="email">Eメール</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-row">
          <label for="password">パスワード</label>
          <input type="password" id="password" name="password" required>
        </div>
        <div class="form-row">
          <label for="password-confirm">パスワード（確認用）</label>
          <input type="password" id="password-confirm" name="password-confirm" required>
        </div>
        <div class="form-row large-row">
          <input type="submit" value="登録">
        </div>
      </div>
  </div>  
  </form>
</body>
</html>

<?php
// データベース接続を閉じる
$conn->close();
?>
