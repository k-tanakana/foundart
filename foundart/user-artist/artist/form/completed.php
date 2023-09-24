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
  $icon_img = $_FILES["icon_img"]["name"];
  $main_img = $_FILES["main_img"]["name"];
  $description_text = $_POST["description_text"];echo nl2br($description_text);

  $unlink_file_path = "../dynamic/" . $db_artist_name . ".php";
unlink($unlink_file_path);

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
        header("Location: input.php");
      } else {
          echo "取得エラー: " . $conn->error;
      }
  }
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
    
    $dynamic_file_path = "../dynamic/" . $artist_name . ".php";

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

\$artist_name = "$artist_name";
\$main_img = "$main_img";

\$query = "SELECT artist_name ,main_img ,icon_img ,twitter_url ,instagram_url,facebook_url,description_text,homepage_url FROM artist WHERE artist_name = '$artist_name'";
\$result = mysqli_query(\$connection, \$query);

if (\$result) {
    echo "";
} else {
    die("クエリの実行に失敗しました: " );
}

\$row = mysqli_fetch_assoc(\$result);
\$artist_name = \$row['artist_name'];
\$main_img = \$row['main_img'];
\$main_img = \$row['main_img'];
\$icon_img = \$row['icon_img'];
\$twitter_url = \$row['twitter_url'];
\$instagram_url = \$row['instagram_url'];
\$facebook_url=\$row['facebook_url'] ;
\$homepage_url=\$row['homepage_url'] ;
\$description_text=\$row['description_text'];

echo "<img src=\"../img/\$main_img\" class='main-img'>";
echo"<div class='page-grid'>";
echo"<div class='detail-artist-detail-grid'>";
echo"<div class='item1'>";
echo"<img src=\"../img/\$icon_img\" class='artist-icon'>";
echo"</div>";
echo"<div class='item2'>";
echo"<h3 class='artist-name'>\$artist_name</h3>";
echo"<span class='icon-img'>";
echo"<a href='\$twitter_url'><img src=\"../../../site-img/Twitter social icons - square - blue.png\" class='twitter-icon'></a>";
echo"<a href='\$instagram_url'><img src=\"../../../site-img/Instagram_Glyph_Gradient.png\"></a>";
echo"<a href='\$facebook_url'><img src=\"../../../site-img/f_logo_RGB-Blue_512.png\"></a>";
echo"<a href='\$homepage_url'><img src=\"../../../site-img/シンプルな家のフリーアイコン素材 7.jpeg\"></a>";
echo"</span>";
echo"<div class='artist-text-profile'>\$description_text</div>";
echo"</div>";
echo"</div>";
echo"</div>";
mysqli_close(\$connection);
?>
<div class="page-grid">
<div class="artist-content">
    <input type="radio" name="tab_name" id="tab1" checked>
    <label class="tab_class" for="tab1">EXHIBITION</label>
    <div class="content_class">
        <div class="detail">
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

            \$query = "SELECT exhibition_title ,top_img FROM exhibition WHERE artist_id = (SELECT artist_id FROM artist WHERE artist_name = '\$artist_name')";
            \$result = mysqli_query(\$connection, \$query);

            if (\$result) {
                echo "";
            } else {
                die("クエリの実行に失敗しました: " );
            }

            while (\$row = mysqli_fetch_assoc(\$result)) {
                \$exhibition_title = \$row['exhibition_title'];
                \$top_img = \$row['top_img'];

                echo"<div class='item'>";
                echo"<a href=\"../../exhibition/dynamic/\$exhibition_title.php\"><img src=\"../../exhibition/img/\$top_img\" class='artist-content-img'></a>";
                echo"</div>"; 
            }

            mysqli_close(\$connection);
            ?>
        </div>
    </div>
    <input type="radio" name="tab_name" id="tab2" checked>
    <label class="tab_class" for="tab2">FEED</label>
    <div class="content_class">
        <div class="detail">
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

    \$query = "SELECT feed_img, feed_title FROM feed WHERE artist_id = (SELECT artist_id FROM artist WHERE artist_name = '\$artist_name')";
    \$result = mysqli_query(\$connection, \$query);

    if (\$result) {
        echo "";
    } else {
        die("クエリの実行に失敗しました: " );
    }

    while (\$row = mysqli_fetch_assoc(\$result)) {
        \$feed_title = \$row['feed_title'];
        \$feed_img = \$row['feed_img'];
        \$imageArray = explode(',', \$feed_img);

        if (!empty(\$imageArray[0])) {
            echo "<div class='item'>";
            echo "<a href=\"../../feed/dynamic/\$feed_title.php\"><img src=\"../../feed/img/\$imageArray[0]\" class='artist-content-img'></a>";
            echo "</div>"; 
        }
    }
    mysqli_close(\$connection);
?>

        </div>
    </div>
</div>

HTML;

    if (file_put_contents($dynamic_file_path, $dynamic_content) !== false) {
        echo "展覧会情報ページのファイルが正常に保存されました。";
    } else {
        echo "エラー：展覧会情報ページのファイルを保存できませんでした。";
    }

    // ...

?>