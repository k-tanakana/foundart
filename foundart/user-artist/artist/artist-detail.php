<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>FOUND ART / TOP</title>
<link href="artist.css" rel="stylesheet" type="text/css" />
<link href="basic-structure.css" rel="stylesheet" type="text/css" />
</head>
<p>ログイン</p>
<header>
  <h1 class="title"><a href="index.php">FOUND ART</a></h1>
    <nav class="nav">
      <ul class="menu-group">
          <li class="menu-item"><a href="../../../list.php">EXHIBITIONS</a></li>
          <li class="menu-item"><a href="../../../feed-list.php">FEEDS</a></li>
          <li class="menu-item"><a href="#">COLUMN</a></li>
      </ul>
    </nav>
</header>
<!-------------------ヘッダー終わり------------------->
<body>
    <img src="sample-other/feeds-sample-img.jpg" class="top-img">
    <div class="page-grid">
       <div class="detail-artist-detail-grid">
        <div class="item1">
            <img src="sample-other/artists-icon-sample-img.jpg" class="artist-icon">
        </div>
        <div class="item2">
            <h3 class="artist-name">作家名</h3>
            <span class="icon-img">
                <a href="       "><img src="sample-mein/Twitter social icons - square - blue.png" class="twitter-icon"></a>
                <a href="       "><img src="sample-mein/Instagram_Glyph_Gradient.png"></a>
                    <a href="       "><img src="sample-mein/f_logo_RGB-Blue_512.png"></a>
                <a href="       "><img src="sample-mein/シンプルな家のフリーアイコン素材 7.jpeg"></a>
            </span>
            <div class="artist-text-profile">アーティスト概要</div>
        </div>
    </div>
    </div>
    <div class="artist-content">
        <input type="radio" name="tab_name" id="tab1" checked>
        <label class="tab_class" for="tab1">FEED</label>
        <div class="content_class">
            <div class="detail">
                <div class="item">
                    <a href="feed-detail.php"><img src="sample-other/feeds-sample (1).jpg" class="artist-content-img"></a>
                </div>
            </div>
        </div>
        <input type="radio" name="tab_name" id="tab2">
        <label class="tab_class" for="tab2">EXHIBITION</label>
        <div class="content_class">
            <div class="detail">
                <div class="item">
                    <a href="exhibition-detail.php"><img src="sample-other/exhibition-top-sample-img.JPG" class="artist-content-img"></a>
                    <div class="universally-text">展覧会タイトル</div>
                    <div class="universally-text">開催状況</div>
                </div>
                <div class="item">
                    <a href="exhibition-detail.php"><img src="sample-other/exhibition-top-sample-img.JPG" class="artist-content-img"></a>
                    <div class="universally-text">展覧会タイトル</div>
                    <div class="universally-text">開催状況</div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>