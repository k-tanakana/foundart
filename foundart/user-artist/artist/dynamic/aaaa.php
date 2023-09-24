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

if (isset($_SESSION["member_id"])) {
   
    echo '<a href="registration/mypage.php" class="login">マイページ</a>';
} else {
   
    echo '<a href="registration/login.php" class="login">ログイン</a>';
}
?>

</header>
<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "foundart";

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die("データベースに接続できませんでした: " . mysqli_connect_error());
}

$artist_name = "aaaa";
$main_img = "";

$query = "SELECT artist_name ,main_img ,icon_img ,twitter_url ,instagram_url,facebook_url,description_text,homepage_url FROM artist WHERE artist_name = 'aaaa'";
$result = mysqli_query($connection, $query);

if ($result) {
    echo "";
} else {
    die("クエリの実行に失敗しました: " );
}

$row = mysqli_fetch_assoc($result);
$artist_name = $row['artist_name'];
$main_img = $row['main_img'];
$main_img = $row['main_img'];
$icon_img = $row['icon_img'];
$twitter_url = $row['twitter_url'];
$instagram_url = $row['instagram_url'];
$facebook_url=$row['facebook_url'] ;
$homepage_url=$row['homepage_url'] ;
$description_text=$row['description_text'];

echo "<img src=\"../img/$main_img\" class='main-img'>";
echo"<div class='page-grid'>";
echo"<div class='detail-artist-detail-grid'>";
echo"<div class='item1'>";
echo"<img src=\"../img/$icon_img\" class='artist-icon'>";
echo"</div>";
echo"<div class='item2'>";
echo"<h3 class='artist-name'>$artist_name</h3>";
echo"<span class='icon-img'>";
echo"<a href='$twitter_url'><img src=\"../../../site-img/Twitter social icons - square - blue.png\" class='twitter-icon'></a>";
echo"<a href='$instagram_url'><img src=\"../../../site-img/Instagram_Glyph_Gradient.png\"></a>";
echo"<a href='$facebook_url'><img src=\"../../../site-img/f_logo_RGB-Blue_512.png\"></a>";
echo"<a href='$homepage_url'><img src=\"../../../site-img/シンプルな家のフリーアイコン素材 7.jpeg\"></a>";
echo"</span>";
echo"<div class='artist-text-profile'>$description_text</div>";
echo"</div>";
echo"</div>";
echo"</div>";
mysqli_close($connection);
?>
<div class="page-grid">
<div class="artist-content">
    <input type="radio" name="tab_name" id="tab1" checked>
    <label class="tab_class" for="tab1">EXHIBITION</label>
    <div class="content_class">
        <div class="detail">
            <?php
            $host = "localhost";
            $username = "root";
            $password = "password";
            $database = "foundart";
            $port = "3307";

            $connection = mysqli_connect($host, $username, $password, $database, $port);

            if (!$connection) {
                die("データベースに接続できませんでした: " . mysqli_connect_error());
            }

            $query = "SELECT exhibition_title ,top_img FROM exhibition WHERE artist_id = (SELECT artist_id FROM artist WHERE artist_name = '$artist_name')";
            $result = mysqli_query($connection, $query);

            if ($result) {
                echo "";
            } else {
                die("クエリの実行に失敗しました: " );
            }

            while ($row = mysqli_fetch_assoc($result)) {
                $exhibition_title = $row['exhibition_title'];
                $top_img = $row['top_img'];

                echo"<div class='item'>";
                echo"<a href=\"../../exhibition/dynamic/$exhibition_title.php\"><img src=\"../../exhibition/img/$top_img\" class='artist-content-img'></a>";
                echo"</div>"; 
            }

            mysqli_close($connection);
            ?>
        </div>
    </div>
    <input type="radio" name="tab_name" id="tab2" checked>
    <label class="tab_class" for="tab2">FEED</label>
    <div class="content_class">
        <div class="detail">
        <?php


    $connection = mysqli_connect($host, $username, $password, $database);

    if (!$connection) {
        die("データベースに接続できませんでした: " . mysqli_connect_error());
    }

    $query = "SELECT feed_img, feed_title FROM feed WHERE artist_id = (SELECT artist_id FROM artist WHERE artist_name = '$artist_name')";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "";
    } else {
        die("クエリの実行に失敗しました: " );
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $feed_title = $row['feed_title'];
        $feed_img = $row['feed_img'];
        $imageArray = explode(',', $feed_img);

        if (!empty($imageArray[0])) {
            echo "<div class='item'>";
            echo "<a href=\"../../feed/dynamic/$feed_title.php\"><img src=\"../../feed/img/$imageArray[0]\" class='artist-content-img'></a>";
            echo "</div>"; 
        }
    }
    mysqli_close($connection);
?>

        </div>
    </div>
</div>
