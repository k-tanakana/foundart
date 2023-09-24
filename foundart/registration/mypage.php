<?php
session_start();

// セッションを確認してログインしていなければログインページにリダイレクト
if (!isset($_SESSION["member_id"])) {
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
<link href="mypage.css" rel="stylesheet" type="text/css" />
<link href="../user-artist/artist/artist.css" rel="stylesheet" type="text/css" />
<link href="../basic-structure.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100&display=swap" rel="stylesheet">
</head>
<header>
  <h1><a href="../index.php">FOUND ART</a></h1>
    <nav class="nav">
      <ul class="menu-group">
          <li class="menu-item"><a href="../user-artist/exhibition/list.php">EXHIBITIONS</a></li>
          <li class="menu-item"><a href="../user-artist/feed/list.php">FEEDS</a></li>
          <li class="menu-item"><a href="#">COLUMN</a></li>
      </ul>
    </nav>
    <span class="select-form">
        <button onclick="window.location.href='../user-artist/artist/form/input.php'">
        <img src="../site-img/icon_053660_256.png"></button>
        <button onclick="window.location.href='../user-artist/exhibition/form/input.php'"><img src="../site-img/icon_010340_256.png"></button>
        <button onclick="window.location.href='../user-artist/feed/form/input.php'"><img src="../site-img/icon_002660_256.png"></button>
        <?php


if (isset($_SESSION[""])) {
   
    echo '<a href="registration/mypage.php" class="login">マイページ</a>';
} else {
   
    echo '<a href="registration/login.php" class="login">ログイン</a>';
}
?>

      </span>
</header>
<body>
  
  <?php
  $host = "localhost";
  $username = "root";
  $password = "";
  $dbname = "foundart";
  
  $connection = new mysqli($host, $username, $password, $dbname);

  if (!$connection) {
    die("データベースに接続できませんでした: " . mysqli_connect_error());
}
  
$artist_id = $_SESSION["artist_id"];
$query="SELECT artist_name,phone_number,icon_img,main_img,exhibition_id,description_text,instagram_url,twitter_url,facebook_url,homepage_url,mail_address,painting,sculpture,design,industrial_arts,movie,other,status,name,feed_id,venue_address from artist where artist_id = '$artist_id'";

$result = mysqli_query($connection, $query);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {

      $artist_name = $row["artist_name"];
      $phone_number = $row["phone_number"];
      $icon_img = $row["icon_img"];
      $main_img = $row["main_img"];
      $exhibition_id = $row["exhibition_id"];
      $description_text = $row["description_text"];
      $instagram_url = $row["instagram_url"];
      $twitter_url = $row["twitter_url"];
      $facebook_url = $row["facebook_url"];
      $homepage_url = $row["homepage_url"];
      $mail_address = $row["mail_address"];
      $painting = $row["painting"];
      $sculpture = $row["sculpture"];
      $design = $row["design"];
      $industrial_arts = $row["industrial_arts"];
      $movie = $row["movie"];
      $other = $row["other"];
      $status = $row["status"];
      $name = $row["name"];
      $feed_id = $row["feed_id"];
      $venue_address = $row["venue_address"];

    echo "<img src='../user-artist/artist/img/$main_img' class='main-img'>";
      echo "<div class='page-grid'>";
        echo "<div class='detail-artist-detail-grid'>";
          echo "<div class='item1'>";
            echo "<img src='../user-artist/artist/img/$icon_img' class='artist-icon'>";
          echo "</div>";
          echo "<div class='item2'>";
            echo "<div class='artist-prof'>";
              echo "<h3 class='artist-name'>$artist_name</h3>";
              echo "<a href='#' class='btn-brackets'>フォロー</a>";
            echo " </div>";
            echo "<div class='icon-container'>";
              echo "<div class='left-icon'>";
                echo "<a href='$twitter_url'><img src='../site-img/Twitter social icons - square - blue.png' class='twitter-icon'></a>";
                echo "<a href='$instagram_url'><img src='../site-img/Instagram_Glyph_Gradient.png'></a>";
                echo "<a href='$facebook_url'><img src='../site-img/f_logo_RGB-Blue_512.png'></a>";
                echo "<a href='$homepage_url'><img src='../site-img/シンプルな家のフリーアイコン素材 7.svg'></a>";
              echo "</div>";
              echo "<div class='right-icon'>";
              echo "<img src ='../site-img/heart.png'>";
              echo "<img src ='../site-img/share-square.png'>";
              echo "</div>";
            echo "</div>";
            echo "<div class='artist-text-profile'>$description_text</div>";
          echo "</div>";
        echo "</div>";
  }
} else {
  echo "";
}

?>


<div class='artist-content'>
<input type='radio' name='tab_name' id='tab1' checked>
<label class='tab_class' for='tab1'>FEED</label>
<div class='content_class'>
<div class='detail'>
<?php


$connection = new mysqli($host, $username, $password, $dbname);

if (!$connection) {     
  die("データベースに接続できませんでした: " . mysqli_connect_error());}

$artist_id = $_SESSION["artist_id"];
$query="SELECT feed_img,feed_title from feed where artist_id = '$artist_id'";
$result = mysqli_query($connection, $query);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
  $feed_img = $row["feed_img"];
  $feed_title = $row["feed_title"];
  


    echo "      <div class='item'>";
    echo "          <a href='../user-artist/feed/dynamic/$feed_title.php'><img src='../user-artist/feed/img/$feed_img' class='artist-content-img'></a>";
    echo "      </div>";
  }
} else {
  echo "";
}

// 接続を閉じる
mysqli_close($connection);
?>
</div>
</div>
<input type='radio' name='tab_name' id='tab2'>
<label class='tab_class' for='tab2'>EXHIBITION</label>
<div class='content_class'>
<div class='detail'>
<?php


$connection = new mysqli($host, $username, $password, $dbname);

if (!$connection) {     
  die("データベースに接続できませんでした: " . mysqli_connect_error());}

$artist_id = $_SESSION["artist_id"];
$query="SELECT event_status,top_img,exhibition_title from exhibition where artist_id = '$artist_id'";
$result = mysqli_query($connection, $query);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
  $event_status = $row["event_status"];
  $top_img = $row["top_img"];
  $exhibition_title = $row["exhibition_title"];

    echo "      <div class='item'>";
    echo "          <a href='../user-artist/exhibition/dynamic/$exhibition_title.php'><img src='../user-artist/exhibition/img/$top_img' class='artist-content-img'></a>";
    echo "          <div class='universally-text'>$exhibition_title</div>";
    echo "          <div class='universally-text'>$event_status</div>";
    echo "      </div>";

  }
} else {
  echo "";
}

// 接続を閉じる
mysqli_close($connection);
?>
</div>
</div>
</div>
</div>
</body>
</html>



