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
    <section class="bs-s__ribbon brd-black-bg">
    <!-- This search bar needs to be able to query database -->
      <form action="">
        <input type="search" class="bs-ipt__txt">
        <button class="bs-btn">Search</button>
      </form>

    </section>
    
    <section class="bs-s__ribbon bs-flex-around">

      <div>
        <h1 class="bs-hed bs-lrg">Admin Dashboard</h1>
        <h2 class="bs-hed__scd bs-mod">Blog Posts</h2>
      </div>

      <div class="bs-c__panel">
        <div class="bs-c--hdr">
          <h3 class="bs-hed__trd">Topics</h3>
        </div>
        <div class="bs-c--body">
        <?php foreach($topics as $topic) ?>
        
          <a href=<?= $topic["id"] ?> class="bs-lnk__wrp bs-mid"><?= $topic["name"] ?></a>
        <?php ?>
          
          <!-- Get all topic and put them here -->
          <form>
            <input type="text" class="bs-ipt__txt">
            <button class="bs-btn">Add</button>
          </form>
        </div>
      </div>
      
    </section>

    <section class="bs-s__mid bs-grid">

      <div class="bs-grid--item-3c bs-s__sml bs-flex-center">
        <a href="/controllers/ctrl-posts.php?action=post_create_view" class="bs-btn bs-mid">Create Blog Post</a>
      </div>

      <div class="bs-grid--item-9c bs-flex-center">
        <?php foreach($posts as $post) { ?>
        <div class="bs-c__panel bs-shadow">
          <div class="bs-c--hdr">
            <h3 class="bs-hed bs-mdm"><?=$post['titleBlog'] ?></h3>
          </div>
          <div class="bs-c--body">
            <a href="/controllers/ctrl-posts.php?action=post_edit_view&id=<?=$post['id']?>" class="bs-btn">Edit</a>
          </div>
        </div>
        <?php }?>
      </div>

    </section>

	</main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'?>
</body>
<!-- <script type="text/javascript" src="../../assets/main.js"></script> -->
<script type="text/javascript" src="https://raw.githack.com/matthewLeFevre/beautiful_site/master/assets/main.js"></script>
</html>