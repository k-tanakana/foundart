<?php
session_start();
//DB情報
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
    // member_idを取得
    if (isset($_SESSION["artist_id"])) {
        $artist_id = $_SESSION["artist_id"];
    } else {
        // member_idがない場合は何らかのエラー処理を行う
        die("エラー: ログイン情報が不足しています。");
    }

    // 入力値の取得
    $feed_title = $_POST["feed_title"];
    $description_text = $_POST["description_text"];

    // feed_idを生成
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $feed_id = '';
    $length = 10;

    for ($i = 0; $i < $length; $i++) {
        $feed_id .= $characters[rand(0, strlen($characters) - 1)];
    }

    // 画像ファイルのアップロード処理
    $feed_img=$_FILES["feed_img"]["name"];
    $feed_img_path="../img/".$feed_img;
    move_uploaded_file($_FILES["feed_img"]["tmp_name"],$feed_img_path);

}
    // feed-dynamicフォルダへのファイル生成
       $dynamic_file_path = "../dynamic/" . $feed_title . ".php";

    $dynamic_content = <<<HTML

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Language" content="ja">
<title>FOUND ART / TOP</title>
<link href="../artist.css" rel="stylesheet" type="text/css" />
<link href="../../../basic-structure.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
</head>
<header>
  <h1><a href="index.php">FOUND ART</a></h1>
    <nav class="nav">
      <ul class="menu-group">
          <li class="menu-item"><a href="user-artist/exhibition/list.php">EXHIBITIONS</a></li>
          <li class="menu-item"><a href="user-artist/feed/list.php">FEEDS</a></li>
          <li class="menu-item"><a href="#">COLUMN</a></li>
      </ul>
    </nav>
    </nav>
<?php

session_start();

if (isset(\$_SESSION["member_id"])) {
   
    echo '<a href="registration/mypage.php" class="login">マイページ</a>';
} else {
   
    echo '<a href="registration/login.php" class="login">ログイン</a>';
}
?>

</header>
HTML;
    if (file_put_contents($dynamic_file_path, $dynamic_content) !== false) {
        echo "フィード情報ページのファイルが正常に保存されました。";
    } else {
        echo "エラー：フィード情報ページのファイルを保存できませんでした。";
    }

    // SQLクエリを作成してデータを挿入
    $sql = "INSERT INTO feed (feed_id,feed_title, description_text, feed_img, artist_id) 
    VALUES ('$feed_id','$feed_title', '$description_text', '$feed_img', '$artist_id')";

    if ($conn->query($sql) === TRUE) {
        echo "データが正常に登録されました。";
    } else {
        echo "エラー: " . $conn->error;
    }

    // フォーム入力ページにリダイレクト
    header("Location:  ../../../registration/mypage.php");
    exit();

