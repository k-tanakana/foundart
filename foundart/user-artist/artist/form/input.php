<?php

$host = "localhost";
$username = "root";
$password = "password";
$dbname = "foundart";
$port = "3307";

$conn = new mysqli($host, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("接続エラー: " . $conn->connect_error);
}

session_start();

if (!isset($_SESSION["artist_id"])) {
    header("Location: ../../../registration/login.php");
    exit();
}

// データベースからアーティスト情報を取得
$artist_id = $_SESSION["artist_id"];
$artist_info_query = "SELECT artist_name, name, phone_number, instagram_url, twitter_url, facebook_url, homepage_url ,icon_img ,main_img ,description_text FROM artist WHERE artist_id = ?";
$stmt = $conn->prepare($artist_info_query);
$stmt->bind_param("s", $artist_id); // "s" は変数の型を指定（文字列と仮定）
$stmt->execute(); // クエリを実行
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $db_artist_name = $row["artist_name"];
    $db_name = $row["name"];
    $db_phone_number = $row["phone_number"];
    $db_instagram_url = $row["instagram_url"];
    $db_twitter_url = $row["twitter_url"];
    $db_facebook_url = $row["facebook_url"];
    $db_homepage_url = $row["homepage_url"];
    $db_description_text = $row["description_text"];
    $db_icon_img = $row["icon_img"];
    $db_main_img = $row["main_img"];
    $result->close(); // $result を閉じる
} else {
    // Handle query error
    echo "取得エラー: " . $conn->error;
}

// ステートメントを閉じる
$stmt->close();

// フォームデータの受け取りとデータベースの更新処理
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $artist_name = $_POST["artist_name"];
  $name = $_POST["name"];
  $phone_number = $_POST["phone_number"];
  $instagram_url = $_POST["instagram_url"];
  $twitter_url = $_POST["twitter_url"];
  $facebook_url = $_POST["facebook_url"];
  $homepage_url = $_POST["homepage_url"];
  $description_text = $_POST["description_text"];
  $icon_img = $_FILES["icon_img"]["name"];
  $main_img = $_FILES["main_img"]["name"];

  // データベースから取得した値とフォームの値を比較し、変更されたフィールドを特定
  // フォームデータの受け取り
  $update_fields = array();

  // アーティスト名の変更チェック
  if ($db_artist_name !== $_POST["artist_name"]) {
      $update_fields[] = "artist_name = '" . $_POST["artist_name"] . "'";
  }

  // 本名の変更チェック
  if ($db_name !== $_POST["name"]) {
      $update_fields[] = "name = '" . $_POST["name"] . "'";
  }

  // 電話番号の変更チェック
  if ($db_phone_number !== $_POST["phone_number"]) {
      $update_fields[] = "phone_number = '" . $_POST["phone_number"] . "'";
  }

  // Instagram URLの変更チェック
  if ($db_instagram_url !== $_POST["instagram_url"]) {
      $update_fields[] = "instagram_url = '" . $_POST["instagram_url"] . "'";
  }

  // Twitter URLの変更チェック
  if ($db_twitter_url !== $_POST["twitter_url"]) {
      $update_fields[] = "twitter_url = '" . $_POST["twitter_url"] . "'";
  }

  // Facebook URLの変更チェック
  if ($db_facebook_url !== $_POST["facebook_url"]) {
      $update_fields[] = "facebook_url = '" . $_POST["facebook_url"] . "'";
  }

  // ホームページ URLの変更チェック
  if ($db_homepage_url !== $_POST["homepage_url"]) {
      $update_fields[] = "homepage_url = '" . $_POST["homepage_url"] . "'";
  }

  if ($db_description_text !== $_POST["description_text"]) {
    $update_fields[] = "description_text = '" . $_POST["description_text"] . "'";
}

  function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
 // 画像アップロード処理
if ($_FILES["icon_img"]["size"] > 0) {
    $icon_img = generateRandomString() . ".jpg"; // 例：abcdef1234.jpg
    $icon_img_path = "../img/" . $icon_img;
    move_uploaded_file($_FILES["icon_img"]["tmp_name"], $icon_img_path);
    $update_fields[] = "icon_img = '" . $icon_img . "'";
}

if ($_FILES["main_img"]["size"] > 0) {
  $main_img = generateRandomString() . ".jpg"; // 例：5678ghijkl.jpg
  $main_img_path = "../img/" . $main_img;
  move_uploaded_file($_FILES["main_img"]["tmp_name"], $main_img_path);
  $update_fields[] = "main_img = '" . $main_img . "'";
}

  // アップデートが必要な項目がある場合、アップデートクエリを生成して実行
  if (!empty($update_fields)) {
      $update_query = "UPDATE artist SET " . implode(', ', $update_fields) . " WHERE artist_id = '$artist_id'";
      if ($conn->query($update_query) === TRUE) {
          echo "更新完了";
          echo '<meta http-equiv="refresh" content="0">';
      } else {
          echo "取得エラー: " . $conn->error;
      }
  }
}
?>

<!DOCTYPE html>
<html>
<?php

// セッションを確認してログインしていなければログインページにリダイレクト
if (!isset($_SESSION["member_id"])) {
    header("Location: login.php");
    exit();
}

// 会員IDに紐づいたページの処理をここに記述

// ログアウト処理
if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Language" content="ja">
<title>FOUND ART / TOP</title>
<link href="../../../form.css" rel="stylesheet" type="text/css" />
<link href="../../../basic-structure.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100&display=swap" rel="stylesheet">
</head>
<header>
  <h1 class="title"><a href="../../../index.php">FOUND ART</a></h1>
    <nav class="nav">
      <ul class="menu-group">
          <li class="menu-item"><a href="../exhibition/list.php">EXHIBITIONS</a></li>
          <li class="menu-item"><a href="../feed/list.php">FEEDS</a></li>
          <li class="menu-item"><a href="#">COLUMN</a></li>
      </ul>
    </nav>
    <?php
// ログイン状態の判定（ここではmember_idがセッションに保存されているかをチェック）
if (isset($_SESSION["member_id"])) {
    // ログインしている場合は「ログアウト」を表示し、リンクにlogout.phpを挿入
    echo '<a href="../../../registration/mypage.php">マイページ</a>';
} else {
    // ログアウトしている場合は「ログイン」を表示し、リンクにlogin.phpを挿入
    echo '<a href="login.php">ログイン</a>';
}
?>
</header>
<body>
<!-- ヘッダーコードは省略 -->

<div class="page-grid">
    <h2>アーティスト登録フォーム</h2>
    <form action="completed.php" method="post" enctype="multipart/form-data">
    <div class="form-container">
        <div class="form-row large-row">
            <label for="artist_name">アーティスト名:</label>
            <input type="text" id="artist_name" name="artist_name" required value="<?php echo $db_artist_name; ?>">
        </div>
        <div class="form-row">
            <label for="name">本名</label>
            <input type="text" id="name" name="name" value="<?php echo $db_name; ?>">
        </div>
        <div class="form-row large-text">
            <label for="phone_number">電話番号</label>
            <input type="text" id="phone_number" name="phone_number" pattern="[0-9,-]*" title="半角数字で入力してください" value="<?php echo $db_phone_number; ?>">
        </div>
        <div class="form-row">
            <label for="instagram_url">Instagram URL</label>
            <input type="text" id="instagram_url" name="instagram_url" value="<?php echo $db_instagram_url; ?>">
        </div>
        <div class="form-row">
            <label for="twitter_url">Twitter URL</label>
            <input type="text" id="twitter_url" name="twitter_url" value="<?php echo $db_twitter_url; ?>">
        </div>
        <div class="form-row">
            <label for="facebook_url">Facebook URL</label>
            <input type="text" id="facebook_url" name="facebook_url" value="<?php echo $db_facebook_url; ?>">
        </div>
        <div class="form-row">
            <label for="homepage_url">ホームページ URL</label>
            <input type="text" id="homepage_url" name="homepage_url" value="<?php echo $db_homepage_url; ?>">
        </div>
        <div class="form-row large-row">
            <label for="description_text">作家概要</label>
            <textarea type="text" id="description_text" name="description_text" value="<?php echo $db_description_text; ?>"></textarea>
        </div>
        <div class="form-row">
      <label for="icon_img">アイコン画像:</label>
      <img src="../img/<?php echo $db_icon_img; ?>">
        <input type="file" id="icon_img" name="icon_img" accept="image/*" value="<?php echo $db_icon_img; ?>">
      </div>
      <div class="form-row">
        <label for="main_img">メイン画像:</label>
        <img src="../img/<?php echo $db_main_img; ?>">
        <input type="file" id="main_img" name="main_img" accept="image/*" value="<?php echo $db_main_img; ?>">
      </div>
      <div class="form-row large-row">
            <input type="submit" value="更新" class="submit">
        </div>
    </div>
    <script>
document.getElementById("submit-button").addEventListener("click", function() {
  document.querySelector("form").submit();
});
</script>
    </form>
</div>

</body>
</html>
