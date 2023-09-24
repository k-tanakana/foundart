<?php
// セッションを開始
session_start();
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

// list
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // データベースからユーザー情報を取得
    $sql = "SELECT member_id, artist_id, email, password FROM registration_membership WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];

        // パスワードの一致を確認
        if (password_verify($password, $hashedPassword)) {
            // ログイン成功
            // セッション変数を設定してログイン状態を保持
            $_SESSION["logged_in"] = true;
            $_SESSION["member_id"] = $row["member_id"];
            
            if (isset($row["artist_id"])) {
                $_SESSION["artist_id"] = $row["artist_id"];
                // リダイレクト先のURLを指定
                $redirect_url = "mypage.php";
            } else {
                // リダイレクト先のURLを指定
                $redirect_url = "../user-artist/artist/form/new-artist-input.php";
            }

            header("Location: " . $redirect_url);
            exit();
        } else {
            echo "パスワードが正しくありません。";
        }
    } else {
        echo "ユーザーが見つかりませんでした。";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Language" content="ja">
<title>FOUND ART / EXHIBITION form</title>
<link href="../../form.css" rel="stylesheet" type="text/css" />
<link href="../basic-structure.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
</head>
<header>
  <h1 class="title"><a href="../index.php">FOUND ART</a></h1>
  <nav class="nav">
    <ul class="menu-group">
        <li class="menu-item"><a href="../../../user-artist/exhibition/exhibition-list.php">EXHIBITIONS</a></li>
        <li class="menu-item"><a href="../../../user-artist/feed/feed-list.php">FEEDS</a></li>
        <li class="menu-item"><a href="#">COLUMN</a></li>
    </ul>
  </nav>
  <?php
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

<body>
<div class="page-grid">
  <h3 class="form-title">ログインフォーム</h3>
  <a href="registration-membership.php">新規登録</a>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="form-container">
      <div class="form-row">
        <label for="email" class="universally-font">Eメール</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-row">
        <label for="password" class="universally-font">パスワード</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-row large-row">
        <input type="button" value="登録" class="submit" id="submit-button">
      </div>
    </div>
  </form>
</div>

<script>
document.getElementById("submit-button").addEventListener("click", function() {
  document.querySelector("form").submit();
});
</script>

</body>
</html>
<?php
// データベース接続を閉じる
$conn->close();
?>
