<?php
session_start();



$host = "localhost";
$username = "root";
$password = "password";
$dbname = "foundart";
$port = "3307";


$conn = new mysqli($host, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("接続エラー: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $exhibition_title = $_POST["exhibition_title"];
    $venue_name = $_POST["venue_name"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $opening_time = $_POST["opening_time"];
    $closing_time = $_POST["closing_time"];
    $location = $_POST["location"];
    $description_text = $_POST["description_text"];
    $contact = $_POST["contact"];
    $remark = $_POST["remark"];
    $event_status = $_POST["event_status"];
    $url = $_POST["url"];
    $venue_address = $_POST["venue_address"];
    $scheduled_attendance_date = $_POST["scheduled_attendance_date"];
    $paintings = isset($_POST["paintings"]) ? $_POST["paintings"] : "";
    $sculptures = isset($_POST["sculptures"]) ? $_POST["sculptures"] : "";
    $designs = isset($_POST["designs"]) ? $_POST["designs"] : "";
    $industrial_arts = isset($_POST["industrial_arts"]) ? $_POST["industrial_arts"] : "";
    $movies = isset($_POST["movies"]) ? $_POST["movies"] : "";
    $others = isset($_POST["others"]) ? $_POST["others"] : "";


    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $exhibition_id = '';
    $length = 10;

    for ($i = 0; $i < $length; $i++) {
        $exhibition_id .= $characters[rand(0, strlen($characters) - 1)];
    }

    $top_img = $_FILES["top_img"]["name"];
    $top_img_path = "../img/" . $top_img;
    move_uploaded_file($_FILES["top_img"]["tmp_name"], $top_img_path);

    $text_imgs = array();
    if (isset($_FILES["text_img"]["tmp_name"])) {
        foreach ($_FILES["text_img"]["tmp_name"] as $key => $tmp_name) {
            $text_img = $_FILES["text_img"]["name"][$key];
            $text_img_path = "../img/" . $text_img;
            move_uploaded_file($tmp_name, $text_img_path);
            $text_imgs[] = $text_img;
        }
    }
    
    

    $text_img = implode(",", $text_imgs);

    $painting = implode(",",$paintings);
    $sculpture = implode(",",$sculptures);
    $design = implode(",",$designs);
    $industrial_art = implode(",",$industrial_arts);
    $movie = implode(",",$movies);
    $other = implode(",",$others);

    if (isset($_SESSION["artist_id"])) {
        $artist_id = $_SESSION["artist_id"];
    } else {
        die("エラー: artist_idが取得できません。");
    }

   
    $dynamic_file_path = "../dynamic/" . $exhibition_title . ".php";

    $dynamic_content = <<<HTML

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Language" content="ja">
<title>FOUND ART / TOP</title>
<link href="../exhibition.css" rel="stylesheet" type="text/css" />
<link href="../../../basic-structure.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
</head>
<header>
  <h1><a href="../../../index.php">FOUND ART</a></h1>
    <nav class="nav">
      <ul class="menu-group">
          <li class="menu-item"><a href=".../list.php">EXHIBITIONS</a></li>
          <li class="menu-item"><a href="../../feed/list.php">FEEDS</a></li>
          <li class="menu-item"><a href="#">COLUMN</a></li>
      </ul>
    </nav>
    </nav>
<?php

session_start();

if (isset(\$_SESSION["member_id"])) {
   
    echo '<a href="../../../registration/mypage.php" class="login">マイページ</a>';
} else {
   
    echo '<a href="../../../registration/login.php" class="login">ログイン</a>';
}
?>

</header>
<body>
    <div class="page-grid">
<?php
\$host = "localhost";
\$username = "root";
\$password = "password";
\$database = "foundart";
\$port = "3307";

\$connection = mysqli_connect(\$host, \$username, \$password, \$database, \$port);

if (!\$connection) {
    die("データベースに接続できませんでした: " . mysqli_connect_error());
}



\$query = "SELECT exhibition_id, exhibition_title, venue_name, start_date, end_date, opening_time, closing_time, location, event_status, contact, remark, scheduled_attendance_date, artist_id, top_img, text_img, description_text ,painting, sculpture, design, industrial_art, movie, other ,url, venue_address FROM exhibition WHERE exhibition_id = '$exhibition_id'";
\$result = mysqli_query(\$connection, \$query);

if (\$result->num_rows > 0) {
    \$row = \$result->fetch_assoc();
    \$exhibition_title = \$row["exhibition_title"];
    \$venue_name = \$row["venue_name"];
    \$start_date = \$row["start_date"];
    \$end_date = \$row["end_date"];
    \$opening_time = \$row["opening_time"];
    \$closing_time = \$row["closing_time"];
    \$location = \$row["location"];
    \$description_text = \$row["description_text"];
    \$contact = \$row["contact"];
    \$remark = \$row["remark"];
    \$event_status = \$row["event_status"];
    \$url = \$row["url"];
    \$venue_address = \$row["venue_address"];
    \$scheduled_attendance_date = \$row["scheduled_attendance_date"];

    \$text_img = \$row["text_img"];
    \$text_imgArray = explode(',', \$text_img);

    \$painting = \$row["painting"];
    \$paintingArray = explode(',', \$painting);

    \$sculpture = \$row["sculpture"];
    \$sculptureArray = explode(',', \$sculpture);

    \$design = \$row["design"];
    \$designArray = explode(',', \$design);

    \$industrial_art = \$row["industrial_art"];
    \$industrial_artArray = explode(',', \$industrial_art);

    \$movie = \$row["movie"];
    \$movieArray = explode(',', \$movie);

    \$other = \$row["other"];
    \$otherArray = explode(',', \$other);
} else {
    // Handle query error
    echo "取得エラー: "  $conn->error;
}

    // データベースからアーティスト情報を取得
\$artist_query = "SELECT artist_name, icon_img FROM artist WHERE artist_id = '$artist_id'";
\$result = mysqli_query(\$connection, \$artist_query);

if (\$result->num_rows > 0) {
    \$row = \$result->fetch_assoc();
    \$db_artist_name = \$row["artist_name"];
    \$db_icon_img = \$row["icon_img"];
    \$result->close(); 
} else {
    // Handle query error
    echo "取得エラー: "  $conn->error;
}
    echo "<img src=\"../img/\$text_img\" alt='テキストイメージ'><body>";
    echo "<div class='grid-container'>";
        echo "<div class='item1'>";
            echo "<div class='artist-icon-container'>";
                echo "<a href=\"../../artist/dynamic/\$db_artist_name.php\">";
                    echo "<img src=\"../../artist/img/\$db_icon_img\">";
                echo "</a>";
            echo "</div>";
            echo "<img class='exhi-detail-top-img' src=\"../../$text_img\">";
        echo "</div>";
        echo "<div class='item2'>";
            echo "<h2>\$exhibition_title</h2>";
            echo "<span>\$start_date</span><span> ～ </span><span>\$end_date</span>";
            echo "<p>出品作品タグ</p>";
            echo "<p>\$description_text</p>";
            echo "<table border='1' class='table-class'>";
                echo "<tr>";
                    echo "<th>会場名</th>";
                    echo "<td>\$venue_name</td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<th>会期</th>";
                    echo "<td>\$start_date  ～  \$end_date</td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<th>在廊予定日</th>";
                    echo "<td>\$scheduled_attendance_date</td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<th>回廊時間</th>";
                    echo "<td>\$opening_time ～ \$closing_time</td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<th>住所</th>";
                    echo "<td>\$venue_address</td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<th>URL</th>";
                    echo "<td>\$url</td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<th>お問合せ</th>";
                    echo "<td>\$contact</td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<th>備考</th>";
                    echo "<td>\$remark</td>";
                echo "</tr>";
            echo "</table>";
            echo "</div>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
HTML;

    if (file_put_contents($dynamic_file_path, $dynamic_content) !== false) {
        echo "展覧会情報ページのファイルが正常に保存されました。";
    } else {
        echo "エラー：展覧会情報ページのファイルを保存できませんでした。";
    }

    $sql = "INSERT INTO exhibition (exhibition_id, exhibition_title, venue_name, start_date, end_date, opening_time, closing_time, location, event_status, contact, remark, scheduled_attendance_date, artist_id, top_img, text_img, description_text ,painting, sculpture, design, industrial_art, movie, other ,url, venue_address) 
    VALUES ('$exhibition_id', '$exhibition_title', '$venue_name', '$start_date', '$end_date', '$opening_time', '$closing_time', '$location', '$event_status', '$contact', '$remark', '$scheduled_attendance_date', '$artist_id', '$top_img', '$text_img','$description_text' ,'$painting', '$sculpture', '$design', '$industrial_art', '$movie', '$other','$url','$venue_address')";

    if ($conn->query($sql) === TRUE) {
        echo "データが正常に登録されました。";
    } else {
        echo "エラー: " . $conn->error;
    }

    // ...
}
?>
</div>
</body>