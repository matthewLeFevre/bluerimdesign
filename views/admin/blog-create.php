<!DOCTYPE HTML>
<html>

<head>


<!-- Google Analytics -->

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-113343693-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-113343693-1');
</script>

<!-- Google Adsense -->

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-1129970047876616",
    enable_page_level_ads: true
  });
</script>


	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Blog Template | BlueRimDesign.com</title>
	<link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
  <!-- <link href="../../assets/main.css" rel="stylesheet" type="text/css"> -->
  <link rel="stylesheet" href="https://rawcdn.githack.com/matthewLeFevre/beautiful_site/master/dist/bs-min-0.0.1.css">
  <link rel="stylesheet" href="/styles.css">
</head>

<body>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'?>

	<main>
    <section class="bs-s__ribbon brd-black-white">
      <h1 class="bs-hed bs-lrg">Create A New Post</h1>
    </section>

    <section class="bs-s__lrg">
      <form class="bs-form__lrg bs-center-margin" method="POST" action="/controllers/ctrl-posts.php">
        <div class="bs-form--set">
          <label for="" class="bs-lbl__txt bs-mid">Blog Title</label>
          <input name="titleBlog" class="bs-ipt__txt__full bs-main" type="text">
        </div>
        <div class="bs-form--set">
          <label for="" class="bs-lbl__txt bs-mid">Blog Web Title</label>
          <input name="titleWeb" class="bs-ipt__txt__full bs-main" type="text">
        </div>
        <div class="bs-form--set">
          <label for="" class="bs-lbl__txt bs-mid">Summary</label>
          <textarea name="summary" class="bs-ipt__area__sml bs-main" type="text"></textarea>
        </div>
        <div class="bs-form--set">
          <label for="" class="bs-lbl__txt bs-mid">Blog Post Body</label>
          <textarea name="markup" class="bs-ipt__area__lrg bs-main" type="text"></textarea>
        </div>
        <div class="bs-form--set">
          <label for="" class="bs-lbl__txt bs-mid">Youtube Video Embed</label>
          <textarea name="videoEmbed" class="bs-ipt__area__sml bs-main" type="text"></textarea>
        </div>
        <div class="bs-form--set">
          <label for="" class="bs-lbl__txt bs-mid">Youtube Video Share Link</label>
          <input name="videoUrl" class="bs-ipt__txt__full bs-main" type="text">
        </div>
        <div class="bs-form--set">
          <label for="" class="bs-lbl__txt bs-mid">Path to Icon</label>
          <input name="iconPath" class="bs-ipt__txt__full bs-main" type="text">
        </div>
        <div class="bs-form--set__align-right">
          <label for="" class="bs-lbl__txt bs-mid">Topic</label>
          <select name="topicId" id="" class="bs-ipt__txt bs-mid">
          <?php foreach($topics as $topic) { ?>
            <option value=<?= $topic['id'] ?>><?= $topic['name']?></option>
          <?php }?>
          </select>
        </div>
        <div class="bs-form--set__align-right">
          <label for="" class="bs-lbl__txt bs-mid">Status</label>
          <select name="status" id="" class="bs-ipt__txt bs-mid">
            <option value="saved">Save</option>
            <option value="published">Publish</option>
          </select>
        </div>
        <div class="bs-form--set">
          <button class="bs-btn" type="submit">Save</button>
          <input type="hidden" name="action" value="post_create_process">
        </div>
      </form>
    </section>

	</main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'?>
</body>
<!-- <script type="text/javascript" src="../../assets/main.js"></script> -->
<script type="text/javascript" src="https://raw.githack.com/matthewLeFevre/beautiful_site/master/assets/main.js"></script>
</html>