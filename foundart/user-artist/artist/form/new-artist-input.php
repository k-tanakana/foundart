<?php
session_start();

if (!isset($_SESSION["member_id"])) {
    header("Location: ../../../registration/login.php");
    exit();
}
?>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Language" content="ja">
<title>FOUND ART / 新規アーティスト登録フォーム</title>
<link href="../../../form.css" rel="stylesheet" type="text/css" />
<link href="../../../basic-structure.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
</head>
<header>
  <h1 class="title"><a href="../../../index.php">FOUND ART</a></h1>
  <nav class="nav">
    <ul class="menu-group">
        <li class="menu-item"><a href="../../../user-artist/exhibition/list.php">EXHIBITIONS</a></li>
        <li class="menu-item"><a href="../../../user-artist/feed/list.php">FEEDS</a></li>
        <li class="menu-item"><a href="#">COLUMN</a></li>
    </ul>
  </nav>
  <?php
  if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: registration/login.php");
    exit();}

  if (isset($_SESSION["member_id"])) {
    echo '<a href="?logout=1" class="login">ログアウト</a>';
    } else {
      echo '<a href="registration/login.php" class="login">ログイン</a>';
      }
    ?>
</header>
<body>
<div class="page-grid">
    <h2 >アーティスト登録フォーム</h2>
    <form action="new-artist-completed.php" method="post" enctype="multipart/form-data">
    <div class="form-container">
      <div class="form-row large-row">
        <label for="artist_name">アーティスト名:</label>
        <input type="text" id="artist_name" name="artist_name" required>
      </div>
      <div class="form-row">
        <label for="name">本名</label>
        <input type="text" id="name" name="name" >
      </div>
      <div class="form-row large-text">
        <label for="phone_number">電話番号</label>
        <input type="text" id="phone_number" name="phone_number" pattern="[0-9,-]*" title="半角数字で入力してください" value="09012341234">
      </div>
      <div class="form-row">
        <label for="instagram-url">Instagram URL</label>
        <input type="text" id="instagram-url" name="instagram-url">
      </div>
      <div class="form-row">
        <label for="twitter-url">Twitter URL</label>
        <input type="text" id="twitter-url" name="twitter-url">
      </div>
      <div class="form-row">
        <label for="facebook-url">Facebook URL</label>
        <input type="text" id="facebook-url" name="facebook-url">
      </div>
      <div class="form-row">
        <label for="homepage-url">ホームページ URL</label>
        <input type="text" id="homepage-url" name="homepage-url">
      </div>
      <div class="form-row large-row">
        <label for="description_text">作家概要</label>
        <textarea type="text" id="description_text" name="description_text"></textarea>
      </div>
      <div class="form-row">
      <label for="icon_img">アイコン画像:</label>
        <input type="file" id="icon_img" name="icon_img" accept="image/*">
      </div>
      <div class="form-row">
        <label for="main_img">メイン画像:</label>
        <input type="file" id="main_img" name="main_img" accept="image/*">
      </div>
      <div class="form-row large-row">
        <input type="button" value="登録" class="submit" id="submit-button">
      </div>
      <script>
        document.getElementById("submit-button").addEventListener("click", function() {
          // 必要なURLフィールドのいずれかが入力されているかを確認
          var instagramUrl = document.getElementById("instagram-url").value;
          var twitterUrl = document.getElementById("twitter-url").value;
          var facebookUrl = document.getElementById("facebook-url").value;
          var homepageUrl = document.getElementById("homepage-url").value;

          if (!instagramUrl && !twitterUrl && !facebookUrl && !homepageUrl) {
            alert("少なくとも1つ以上のURLを入力してください。");
          } else {
            document.querySelector("form").submit();
          }
        });
      </script>
    </div>
    </form>
</div>
</body>
</html>
