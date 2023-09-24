
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>FOUND ART / TOP</title>
<link href="feed.css" rel="stylesheet" type="text/css" />
<link href="../../basic-structure.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
</head>
<header>
  <h1 class="title"><a href="../../index.php">FOUND ART</a></h1>
    <nav class="nav">
      <ul class="menu-group">
          <li class="menu-item"><a href="../exhibition/list.php">EXHIBITIONS</a></li>
          <li class="menu-item"><a href="list.php">FEEDS</a></li>
          <li class="menu-item"><a href="#">COLUMN</a></li>
      </ul>
    </nav>
    <?php

//SESSION関数でログイン部分変更
if (isset($_SESSION[""])) {
    echo '<a href="../../registration/mypage.php" class="login">マイページ</a>';
} else {
    echo '<a href="../../registration/login.php" class="login">ログイン</a>';
}
?>

</header>
<body>
    <div class="listpage-top-container">
        <img class="feeds-img"src="../../site-img/sample-img (1).png">
        <h2 class="page-h2">FEEDS</h2>
        <div class="serch-function-container">
            <div class="input-textbox">
              <div>名前検索</div><label class="artist-name"></label>
              <input id="artist-name-textbox" name="name" type="textbox">
              </div>
            <div class="checkbox">
              <div>ジャンル検索</div>
                <div class="tab-container">
                  <input id="tab1" type="radio" name="tab_menu" checked>
                  <label class="tab_menu" for="tab1">平面</label>
                  <input id="tab2" type="radio" name="tab_menu">
                  <label class="tab_menu" for="tab2">立体</label>
                  <input id="tab3" type="radio" name="tab_menu">
                  <label class="tab_menu" for="tab3">デザイン</label>
                  <input id="tab4" type="radio" name="tab_menu">
                  <label class="tab_menu" for="tab4">工芸</label>
                  <input id="tab5" type="radio" name="tab_menu">
                  <label class="tab_menu" for="tab5">映像</label>
                  <input id="tab6" type="radio" name="tab_menu">
                  <label class="tab_menu" for="tab6">その他</label>

                  <div class="tab_contents" id="menu1">
                    <input type="checkbox" id="oil" value="油彩">
                    <label for="oil">油彩</label>
                    <input type="checkbox" id="acrylic" value="アクリルガッシュ">
                    <label for="acrylic">アクリルガッシュ</label>
                    <input type="checkbox" id="watercolor" value="水彩">
                    <label for="watercolor">水彩</label>
                    <input type="checkbox" id="japanese-painting" value="日本画">
                    <label for="japanese-painting">日本画</label>
                    <input type="checkbox" id="calligraphy" value="書道">
                    <label for="calligraphy">書道</label>
                    <input type="checkbox" id="photography" value="写真">
                    <label for="photography">写真</label>
                    <input type="checkbox" id="drawing" value="ドローイング">
                    <label for="drawing">ドローイング</label>
                    <input type="checkbox" id="illustration" value="イラスト">
                    <label for="illustration">イラスト</label>
                    <input type="checkbox" id="printmaking" value="版画">
                    <label for="printmaking">版画</label>
                    <input type="checkbox" id="plane-concrete" value="平面（具象）">
                    <label for="plane-concrete">平面（具象）</label>
                    <input type="checkbox" id="plane-abstract" value="平面（抽象）">
                    <label for="plane-abstract">平面（抽象）</label>
                  </div>

                  <div class="tab_contents" id="menu2">
                    <input type="checkbox" id="installation" value="インスタレーション">
                    <label for="installation">インスタレーション</label>
                    <input type="checkbox" id="sculpture" value="彫刻">
                    <label for="sculpture">彫刻</label>
                    <input type="checkbox" id="stereo-concrete" value="立体（具象）">
                    <label for="stereo-concrete">立体（具象）</label>
                    <input type="checkbox" id="stereo-abstract" value="立体（抽象）">
                    <label for="stereo-abstract">立体（抽象）</label>
                  </div>

                  <div class="tab_contents" id="menu3">
                    <input type="checkbox" id="textile" value="テキスタイル">
                    <label for="textile">テキスタイル</label>
                    <input type="checkbox" id="product-design" value="プロダクトデザイン">
                    <label for="product-design">プロダクトデザイン</label>
                    <input type="checkbox" id="graphic-design" value="グラフィックデザイン">
                    <label for="graphic-design">グラフィックデザイン</label>
                    <input type="checkbox" id="design-concrete" value="デザイン（具象）">
                    <label for="design-concrete">デザイン（具象）</label>
                    <input type="checkbox" id="design-abstract" value="デザイン（抽象）">
                    <label for="design-abstract">デザイン（抽象）</label>
                  </div>

                  <div class="tab_contents" id="menu4">
                    <input type="checkbox" id="ceramics-lacquer" value="陶磁器・漆">
                    <label for="ceramics-lacquer">陶磁器・漆</label>
                    <input type="checkbox" id="craft-concrete" value="民芸工芸（具象）">
                    <label for="craft-concrete">民芸工芸（具象）</label>
                    <input type="checkbox" id="craft-abstract" value="民芸工芸（抽象）">
                    <label for="craft-abstract">民芸工芸（抽象）</label>
                  </div>

                  <div class="tab_contents" id="menu5">
                    <input type="checkbox" id="film" value="映像・映画">
                    <label for="film">映像・映画</label>
                    <input type="checkbox" id="animation" value="アニメーション">
                    <label for="animation">アニメーション</label>
                    <input type="checkbox" id="video-concrete" value="映像（具象）">
                    <label for="video-concrete">映像（具象）</label>
                    <input type="checkbox" id="video-abstract" value="映像（抽象）">
                    <label for="video-abstract">映像（抽象）</label>
                  </div>

                  <div class="tab_contents" id="menu6">
                    <input type="checkbox" id="media-art" value="メディアアート">
                    <label for="media-art">メディアアート</label>
                    <input type="checkbox" id="architecture" value="建築">
                    <label for="architecture">建築</label>
                    <input type="checkbox" id="performance" value="パフォーマンス">
                    <label for="performance">パフォーマンス</label>
                    <input type="checkbox" id="concrete" value="具象">
                    <label for="concrete">具象</label>
                    <input type="checkbox" id="abstract" value="抽象">
                    <label for="abstract">抽象</label>
                  </div>
                </div>
            </div>
        </div>
    </div>
    
<?php
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

$sql = "SELECT feed_title FROM feed";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="item-grid-container">';
    while ($row = $result->fetch_assoc()) {
        $feed_title = $row["feed_title"];
        echo '    <div class="item-container">';
        echo '        <a href="artist-detail.php">';
        echo '            <img src="sample-other/artist-top-sample-img.jpeg"></a>';
        echo '        <div class="universally-text">' . $feed_title . '</div>';
        echo '    </div>';
    }
    echo '</div>';
} 

$conn->close();
?>
</body>