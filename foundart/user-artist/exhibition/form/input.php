<?php
session_start();

if (!isset($_SESSION["member_id"])) {
    header("Location: ../../../registration/membership/login.php");
    exit();
}
?>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Language" content="ja">
<title>FOUND ART / EXHIBITION form</title>
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
  if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: registration/membership/login.php");
    exit();}

  if (isset($_SESSION["member_id"])) {
    echo '<a href="?logout=1" class="login">ログアウト</a>';
    } else {
      echo '<a href="registration/membership/login.php" class="login">ログイン</a>';
      }
    ?>
</header>
<body>
  <div class="page-grid">
    <h2 class="form-title">展覧会情報登録フォーム</h2>
    <form method="post" action="completed.php" enctype="multipart/form-data">
    <div class="form-container">
      <div class="form-row large-row">
        <label for="exhibition_title">展覧会タイトル</label>
        <input type="text" id="exhibition_title" name="exhibition_title">
      </div>
      <div class="form-row">
      <div class="radio-label">開催状況</div>
      <div class="radio">
        <input type="radio" id="upcoming" name="event_status" value="開催予定">
        <label for="upcoming">開催予定</label>
        <input type="radio" id="ongoing" name="event_status" value="開催中">
        <label for="ongoing">開催中</label>
        <input type="radio" id="closed" name="event_status" value="開催終了">
        <label for="closed">開催終了</label>
      </div>
    </div>
      <div class="form-row">
        <div class="radio-label">展覧会形態</div>
        <div class="radio">
          <input type="radio" id="solo-exhibition" name="event_form" value="個展">
          <label for="solo-exhibition">個展</label>
          <input type="radio" id="group-exhibition" name="event_form" value="グループ展">
          <label for="group-exhibition">グループ展</label>
          <input type="radio" id="graduation-exhibition" name="event_form" value="卒展">
          <label for="graduation-exhibition">卒展</label>
          <input type="radio" id="open-call-exhibition" name="event_form" value="公募展">
          <label for="open-call-exhibition">公募展</label>
        </div>
      </div>
      <div class="form-row">
        <label for="start_date">開始日</label>
        <input type="date" id="start_date" name="start_date" >
      </div>
      <div class="form-row">
        <label for="end_date">終了日</label>
        <input type="date" id="end_date" name="end_date" >
      </div>
      <div class="form-row">
        <label for="top_img">トップ画像</label>
        <input type="file" id="top_img" name="top_img" accept="image/*" >
      </div>
      <div class="form-row">
        <label for="text_img[]">本文掲載画像</label>
        <input type="file" id="text_img" name="text_img[]" accept="image/*" multiple >
      </div>
      <div class="form-row large-row">
      <div class="checkbox-label">作品ジャンル</div>
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
              <input type="checkbox" id="oil" name="paintings[]" value="油彩">
              <label for="oil">油彩</label>
              <input type="checkbox" id="acrylic" name="paintings[]" value="アクリルガッシュ">
              <label for="acrylic">アクリルガッシュ</label>
              <input type="checkbox" id="watercolor" name="paintings[]" value="水彩">
              <label for="watercolor">水彩</label>
              <input type="checkbox" id="japanese-painting" name="paintings[]" value="日本画">
              <label for="japanese-painting">日本画</label>
              <input type="checkbox" id="calligraphy" name="paintings[]" value="書道">
              <label for="calligraphy">書道</label>
              <input type="checkbox" id="photography" name="paintings[]" value="写真">
              <label for="photography">写真</label>
              <input type="checkbox" id="drawing" name="paintings[]" value="ドローイング">
              <label for="drawing">ドローイング</label>
              <input type="checkbox" id="illustration" name="paintings[]" value="イラスト">
              <label for="illustration">イラスト</label>
              <input type="checkbox" id="printmaking" name="paintings[]" value="版画">
              <label for="printmaking">版画</label>
              <input type="checkbox" id="plane-concrete" name="paintings[]" value="平面（具象）">
              <label for="plane-concrete">平面（具象）</label>
              <input type="checkbox" id="plane-abstract" name="paintings[]" value="平面（抽象）">
              <label for="plane-abstract">平面（抽象）</label>
            </div>

            <div class="tab_contents" id="menu2">
              <input type="checkbox" id="installation" name="sculptures[]" value="インスタレーション">
              <label for="installation">インスタレーション</label>
              <input type="checkbox" id="sculpture" name="sculptures[]" value="彫刻">
              <label for="sculpture">彫刻</label>
              <input type="checkbox" id="stereo-concrete" name="sculptures[]" value="立体（具象）">
              <label for="stereo-concrete">立体（具象）</label>
              <input type="checkbox" id="stereo-abstract" name="sculptures[]" value="立体（抽象）">
              <label for="stereo-abstract">立体（抽象）</label>
            </div>

            <div class="tab_contents" id="menu3">
              <input type="checkbox" id="textile" name="designs[]" value="テキスタイル">
              <label for="textile">テキスタイル</label>
              <input type="checkbox" id="product-design" name="designs[]" value="プロダクトデザイン">
              <label for="product-design">プロダクトデザイン</label>
              <input type="checkbox" id="graphic-design" name="designs[]" value="グラフィックデザイン">
              <label for="graphic-design">グラフィックデザイン</label>
              <input type="checkbox" id="design-concrete" name="designs[]" value="デザイン（具象）">
              <label for="design-concrete">デザイン（具象）</label>
              <input type="checkbox" id="design-abstract" name="designs[]" value="デザイン（抽象）">
              <label for="design-abstract">デザイン（抽象）</label>
            </div>

            <div class="tab_contents" id="menu4">
              <input type="checkbox" id="ceramics-lacquer" name="industrial_arts[]" value="陶磁器・漆">
              <label for="ceramics-lacquer">陶磁器・漆</label>
              <input type="checkbox" id="craft-concrete" name="industrial_arts[]" value="民芸工芸（具象）">
              <label for="craft-concrete">民芸工芸（具象）</label>
              <input type="checkbox" id="craft-abstract" name="industrial_arts[]" value="民芸工芸（抽象）">
              <label for="craft-abstract">民芸工芸（抽象）</label>
            </div>

            <div class="tab_contents" id="menu5">
              <input type="checkbox" id="film" name="movies[]" value="映像・映画">
              <label for="film">映像・映画</label>
              <input type="checkbox" id="animation" name="movies[]" value="アニメーション">
              <label for="animation">アニメーション</label>
              <input type="checkbox" id="video-concrete" name="movies[]" value="映像（具象）">
              <label for="video-concrete">映像（具象）</label>
              <input type="checkbox" id="video-abstract" name="movies[]" value="映像（抽象）">
              <label for="video-abstract">映像（抽象）</label>
            </div>

            <div class="tab_contents" id="menu6">
              <input type="checkbox" id="media-art" name="others[]" value="メディアアート">
              <label for="media-art">メディアアート</label>
              <input type="checkbox" id="architecture" name="others[]" value="建築">
              <label for="architecture">建築</label>
              <input type="checkbox" id="performance" name="others[]" value="パフォーマンス">
              <label for="performance">パフォーマンス</label>
              <input type="checkbox" id="concrete" name="others[]" value="具象">
              <label for="concrete">具象</label>
              <input type="checkbox" id="abstract" name="others[]" value="抽象">
              <label for="abstract">抽象</label>
            </div>
        </div>
      </div>
      <div class="form-row large-row">
        <label for="description_text">展覧会説明文</label>
        <textarea type=text id="description_text" name="description_text"></textarea>
      </div>
      <div class="form-row large-row">
        <label for="venue_name">会場名</label>
        <input type="text" id="venue_name" name="venue_name" >
      </div>
      <div class="form-row">
      <label for="venue_address">会場住所</label>
        <input type="text" id="venue_address" name="venue_address">
      </div>
      
      <div class="form-row">
      <label for="location">開催地</label>
        <input type="text" id="location" name="location">
      </div>
      <div class="form-row">
        <label for="opening_time">回廊時間</label>
        <input type="time" id="opening_time" name="opening_time" >
      </div>
      <div class="form-row">
        <label for="closing_time">閉廊時間</label>
        <input type="time" id="closing_time" name="closing_time" >
      </div>
      <div class="form-row">
        <label for="contact">お問合せ</label>
        <input type="text" id="contact" name="contact" >
      </div>
      <div class="form-row">
        <label for="url">URL</label>
        <input type="text" id="url" name="url" >
      </div>
      <div class="form-row">
        <label for="scheduled_attendance_date">在廊予定日</label>
        <textarea type="text" id="scheduled_attendance_date" name="scheduled_attendance_date" ></textarea>
      </div>
      <div class="form-row">
        <label for="remark">備考</label>
        <textarea type="text" id="remark" name="remark" ></textarea>
      </div>
      <div class="form-row large-row">
      <input type="submit" value="登録" class="submit">
      </div>
    </div>
    </div>
    <script>
document.getElementById("submit-button").addEventListener("click", function() {
  document.querySelector("form").submit();
});
</script>
    </form>
  </div>
  </div>

</body>
</html>
