<?php
session_start();

// artist_id確認
if (!isset($_SESSION["artist_id"])) {
    header("Location: ../../../registration/login.php");
    exit();
}
?>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Language" content="ja">
<title>FOUND ART / FEED form</title>
<link href="../../../form.css" rel="stylesheet" type="text/css" />
<link href="../../../basic-structure.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
</head>
<header>
  <h1 class="title"><a href="../../../index.php">FOUND ART</a></h1>
  <nav class="nav">
    <ul class="menu-group">
        <li class="menu-item"><a href="../../../user-artist/exhibition/exhibition-list.php">EXHIBITIONS</a></li>
        <li class="menu-item"><a href="../../../user-artist/feed/feed-list.php">FEEDS</a></li>
        <li class="menu-item"><a href="#">COLUMN</a></li>
    </ul>
  </nav>
  <?php
  //logout確認
  if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: registration/membership/login.php");
    exit();}
  //// member_idを確認
  if (isset($_SESSION["member_id"])) {
    echo '<a href="registration/mypage" class="login">マイページ</a>';
    } else {
      echo '<a href="registration/login.php" class="login">ログイン</a>';
      }
    ?>
</header>
<body>
  <div class="page-grid">
  <h2>展覧会情報登録フォーム</h2>
  <form method="post" action="completed.php" enctype="multipart/form-data">
    <div class="form-container">
      <div class="form-row">
        <label for="feed_title">タイトル</label>
        <input type="text" id="feed_title" name="feed_title" >
      </div>
      <div class="form-row">
        <label for="feed_img">本文掲載画像</label>
        <input type="file" id="feed_img" name="feed_img" accept="image/*">
      </div>
      <div class="form-row large-row">
        <label for="description_text">説明文</label>
        <textarea type="text" id="description_text" name="description_text" ></textarea>
      </div>
      <div class="form-row large-row">
        <input type="submit" value="登録" class="submit">
    </div>
  </div>
  </form>
  </div>
</body>
</html>
