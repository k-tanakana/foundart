<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>FOUND ART / TOP</title>
<link href="feed.css" rel="stylesheet" type="text/css" />
<link href="../../basic-structure.css" rel="stylesheet" type="text/css" />
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
<?php

session_start();

if (isset($_GET["logout"])) {
    //セッション削除
   session_destroy();
   header("Location: registration/login.php");
    exit();
}

if (isset($_SESSION["member_id"])) {
    echo '<a href="registration/mypage.php" class="login">マイページ</a>';
} else {
    echo '<a href="registration/login.php" class="login">ログイン</a>';
}
?>

</header>
<body>
    <div class="page-padding"><div class="grid">
        <div class="feed-detail-item1">
            <div>
                <img src="../../site-img/sample-img (1).png" class="feed-main-img">
            </div>
            <div class="detailpage-feed-detail-text">
                <a href="aritst-detail.php"><img src="../../site-img/sample-img (1).png" class="icon"></a>
                
                <div class="feed-text">フィード概要</div>
                <div>タグ</div>
            </div>
        </div>
        <div class="feed-detail-item2">
            <div class="artist-prof">
                <a href="aritst-detail.php">
                <img src="../../site-img/sample-img (1).png" class="icon"></a>
                <span>アーティスト名</span>
            </div>
            <div class="follow-button">
                <button class="rounded-button">FOLLOW</button>
            </div>
            <div class="image-container">
              <img src="../../site-img/sample-img (1).png" alt="画像1">
              <img src="../../site-img/sample-img (1).png" alt="画像2">
              <img src="../../site-img/sample-img (1).png" alt="画像3">
              <img src="../../site-img/sample-img (1).png" alt="画像4">
            </div>
        </div>
    </div>
    <div class="similar-feed-container">
        <h2 class="similar-feed-text">類似のフィード</h2>
        <div class="similar-feed">
            <img src="../../site-img/sample-img (1).png">
        </div>
    </div>
    </div>
</body>