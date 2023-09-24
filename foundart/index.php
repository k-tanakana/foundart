<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Language" content="ja">
<title>FOUND ART / TOP</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="basic-structure.css" rel="stylesheet" type="text/css" />
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
    <span class="select-form">
        <button onclick="window.location.href='user-artist/artist/form/input.php'">
        <img src="site-img/icon_053660_256.png"></button>
        <button onclick="window.location.href='user-artist/exhibition/form/input.php'"><img src="site-img/icon_010340_256.png"></button>
        <button onclick="window.location.href='user-artist/feed/form/input.php'"><img src="site-img/icon_002660_256.png"></button>
<?php
//SESSION関数でログイン部分変更
if (isset($_SESSION[""])) {
   
    echo '<a href="registration/mypage.php" class="login">マイページ</a>';
} else {
   
    echo '<a href="registration/login.php" class="login">ログイン</a>';
}
?>

      </span>
</header>
<body>
  <div class="page-grid">
    <div class="top-container">
    <img src="site-img/sample-img (1).png">
      <div class="backcolor">  
        <div class="top-text-container">
          <div class="top-text-p">展覧会・作家情報を集約した
          <br>美術系プラットフォーム</div>
          <div class="top-text-p">これまで知らなかった作家・作品に出う</div>
          <h2 class="title">FOUND ART</h2>
        </div>
      </div>
    </div>
    <div class="content-container">
          <h3><a href="user-artist/feed/list.php">FEEDS</a></h3>
            <div class="grid-container">  

<?php
//DB情報
$host = "localhost";
$username = "root";
$password = "";
$dbname = "foundart";

// データベースに接続
$conn = new mysqli($host,$username,$password,$dbname);

// 接続エラーをチェック
if ($conn->connect_error) {
    die("接続エラー: " . $conn->connect_error);
}

$sql = "SELECT feed_img, feed_title FROM feed";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $feed_img =  $row["feed_img"];
        $feed_title = $row["feed_title"];
    }

    echo "<div class='item-container'>";
    echo "<a href='user-artist/feed/dynamic/$feed_title.php'><img src='user-artist/feed/img/$feed_img'></a>";
    echo "</div>";

} else {
    echo "該当する展覧会はありません。";
}
?>

</div>

  <h3><a href="user-artist/exhibition/list.php">EXHIBITIONS</a></h3>
  <h4>開催中の展覧会</h4>
  <div class="grid-container">

<?php
$filter_condition = "event_status = '開催中'";

$table_name = "exhibition";
$field_name_title = "exhibition_title";
$field_name_image = "top_img";
$field_name_link = "exhibition_title";
$field_name_location = "location";
$sql = "SELECT $field_name_title, $field_name_image, $field_name_link, $field_name_location FROM $table_name where $filter_condition";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    //開催中のDB展開
    while ($row = $result->fetch_assoc()) {
        $title = $row[$field_name_title];
        $image_url = "user-artist/exhibition/img/" . $row[$field_name_image];
        $item_link = $row[$field_name_link];
        $location=$row[$field_name_location];

        echo "<div class='item-container'>";
        echo "  <img src=\"$image_url\" alt=\"$title\" href=\"$item_link\">";
        echo "  <div class='page-font'>$title</div><div class='page-font'>$location</div>";
        echo "</div>";
    }
} else {
    echo "該当する展覧会はありません。";
}

?>
  </div>
  <h4>開催予定の展覧会</h4>
    <div class="grid-container">
<?php

$filter_condition = "event_status = '開催予定'";

$sql = "SELECT $field_name_title, $field_name_image, $field_name_link, $field_name_location FROM $table_name where $filter_condition";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    //開催予定のDB展開
    while ($row = $result->fetch_assoc()) {
        $title = $row[$field_name_title];
        $image_url = "user-artist/exhibition/img/" . $row[$field_name_image];
        $item_link = $row[$field_name_link];
        $location=$row[$field_name_location];

        echo "<div class='item-container'>";
        echo "  <img src=\"$image_url\" alt=\"$title\" href=\"$item_link\">";
        echo "  <div class='page-font'>$title</div><div class='page-font'>$location</div>";
        echo "</div>";
    }
} else {
    echo "該当する展覧会はありません。";
}

// 接続を閉じる
$conn->close();
?>
  </div>

<h3>COLUMN</h3>
<div class="grid-container">  
  <div class="item-container">
    <img src="site-img/sample-img (1).png">
    <div class='page-font'>コラムタイトル<br>コラム詳細</div>
  </div>
</div>
</div>
</div>
</body>

<footer>
    <title class="title">
</footer>