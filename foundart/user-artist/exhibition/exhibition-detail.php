<?php
// データベース接続情報
$host = "localhost";
$username = "root";
$password = "password";
$dbname = "foundart"; // あなたのデータベース名に置き換えてください
$port = "3307";

// データベースに接続
$conn = new mysqli($host, $username, $password, $dbname, $port);

// 接続エラーをチェック
if ($conn->connect_error) {
    die("接続エラー: " . $conn->connect_error);
}

// テーブル名を指定
$table_name = "exhibition";

// 詳細ページで表示するアイテムのIDを取得
if (isset($_GET["item_id"])) {
    $item_id = $_GET["item_id"];
} else {
    die("エラー: アイテムIDが指定されていません。");
}

// アイテムの情報を取得するためのSQLクエリ
$sql = "SELECT * FROM $table_name WHERE exhibition_id = '$item_id'";
$result = $conn->query($sql);

// データが見つからなかった場合はエラーメッセージを表示
if ($result->num_rows == 0) {
    die("エラー: 該当のアイテムが見つかりませんでした。");
}

// アイテムの情報を取得
$row = $result->fetch_assoc();
$exhibition_title = $row["exhibition_title"];
$start_date = $row["start_date"];
$end_date = $row["end_date"];
$venue_name = $row["venue_name"];
$venue_address = $row["venue_address"];
$scheduled_attendance_date = $row["scheduled_attendance_date"];
$contact = $row["contact"];
$gallery_hours = $row["opening_time"];
$closing_time = $row["closing_time"];
$text_img_paths = explode(",", $row["text_img"]); // 保存されている複数の画像パスを配列に変換
$top_img_path = $row["top_img"];
?>

<?php
// データベース接続情報
$host = "localhost";
$username = "root";
$password = "password";
$dbname = "foundart"; // あなたのデータベース名に置き換えてください
$port = "3307";

// データベースに接続
$conn = new mysqli($host, $username, $password, $dbname, $port);

// 接続エラーをチェック
if ($conn->connect_error) {
    die("接続エラー: " . $conn->connect_error);
}

// exhibitionテーブルから必要な情報を取得
$sql = "SELECT top_img, event_status, location, exhibition_title, start_date, end_date, venue_name, scheduled_attendance_date, gallery_hours, closing_time, venue_address, contact FROM exhibition";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $top_img_path = "exhibition-img/" . $row["top_img"];
        $event_status = $row["event_status"];
        $location = $row["location"];
        $exhibition_title = $row["exhibition_title"];
        $start_date = $row["start_date"];
        $end_date = $row["end_date"];
        $venue_name = $row["venue_name"];
        $scheduled_attendance_date = $row["scheduled_attendance_date"];
        $gallery_hours = $row["gallery_hours"];
        $closing_time = $row["closing_time"];
        $venue_address = $row["venue_address"];
        $contact = $row["contact"];

        // 個別の詳細ページを生成
        $file_name = "exhibition-dynamic/" . $exhibition_title . ".php";
        $content = <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width'>
    <title>FOUND ART / TOP</title>
    <link href='../exhibition.css' rel='stylesheet' type='text/css' />
    <link href='../../basic-structure.css' rel='stylesheet' type='text/css' />
</head>
<header>
    <h1 class='title'><a href='index.php'>FOUND ART</a></h1>
    <nav class='nav'>
        <ul class='menu-group'>
            <li class='menu-item'><a href='exhibition-list.php'>EXHIBITIONS</a></li>
            <li class='menu-item'><a href='feed-list.php'>FEEDS</a></li>
            <li class='menu-item'><a href='#'>COLUMN</a></li>
        </ul>
    </nav>
</header>
<body>
    <div class='grid-container'>
        <div class='item1'>
            <div class='artist-icon-container'>
                <a href='artist-detail.php'>
                    <img src='sample-other/artists-icon-sample-img.jpg'>
                </a>
            </div>
            <img class='exhi-detail-top-img' src='<?php echo htmlspecialchars($top_img_path); ?>'>
        </div>
        <div class='item2'>
            <h2><?php echo htmlspecialchars($exhibition_title); ?></h2>
            <span><?php echo htmlspecialchars($start_date); ?></span><span> ～ </span><span><?php echo htmlspecialchars($end_date); ?></span>
            <p>出品作品タグ</p>
            <p>展覧会詳細</p>
            <table border='1' class='table-class'>
                <tr>
                    <th>会場名</th>
                    <td><?php echo htmlspecialchars($venue_name); ?></td>
                </tr>
                <tr>
                    <th>会期</th>
                    <td><?php echo htmlspecialchars($start_date) . " ～ " . htmlspecialchars($end_date); ?></td>
                </tr>
                <tr>
                    <th>在廊予定日</th>
                    <td><?php echo htmlspecialchars($scheduled_attendance_date); ?></td>
                </tr>
                <tr>
                    <th>回廊時間</th>
                    <td><?php echo htmlspecialchars($gallery_hours) . " ～ " . htmlspecialchars($closing_time); ?></td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td><?php echo htmlspecialchars($venue_address); ?></td>
                </tr>
                <tr>
                    <th>URL</th>
                    <td></td>
                </tr>
                <tr>
                    <th>お問合せ</th>
                    <td><?php echo htmlspecialchars($contact); ?></td>
                </tr>
                <tr>
                    <th>備考</th>
                    <td>備考</td>
                </tr>
            </table>
        </div>
    </div>
    <!--カラム終わり-->
    <?php
    // Images Included in the Text の画像を表示
    foreach ($text_img_paths as $img_path) {
        echo "<img src='" . htmlspecialchars($img_path) . "' alt='Image'>";
    }
    ?>
    <iframe src='https://'></iframe>
</body>
</html>
HTML;

        // ファイルに書き込み
        file_put_contents($file_name, $content);
    }
} else {
    echo "Exhibition情報がありません。";
}

// データベース接続を閉じる
$conn->close();
?>


// 接続を閉じる
$conn->close();
?>