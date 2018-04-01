<!DOCTYPE HTML>
<html>

<head>


<!-- Google Analytics -->

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-113343693-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-113343693-1', {'page_path': <?php $blog['titleBlog'] ?> + ".php"});
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
  <meta name="description" content="Free Web tutorials">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $blog['titleWeb'] ?> | BlueRimDesign.com</title>
	<link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
  <!-- <link href="../../assets/main.css" rel="stylesheet" type="text/css"> -->
  <link rel="stylesheet" href="https://rawcdn.githack.com/matthewLeFevre/beautiful_site/master/dist/bs-min-0.0.1.css">
  <link rel="stylesheet" href="/styles.css">
  <script src="/app.js"></script>
</head>

<body>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'?>

	<main>

    <section class="bs-s__ribbon bs-flex--flex-start">
      <a href="/controllers/ctrl-posts.php?action=post_edit_view&id=<?= $blog['id'] ?>" class="bs-btn">Edit</a>
      <a href="#" class="bs-btn">Delete</a>
    </section>

  <!-- Youtube Video -->
  <?php if(!empty($blog["videoEmbed"])) { ?>
    <section class="brd-black-bg bs-s__banner brd-video--banner">
      <iframe class="brd-blog-video" src=<?= $blog["videoEmbed"] ?> frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </section>  
  <?php } ?>
    

    <!-- Article container -->
    <section class="bs-s__lrg">

      <article class="bs-s--article">
      
        <h1 class="bs-mod bs-hed"><?= $blog["titleBlog"] ?></h1>
        <p class="bs-mid bs-par__summary"><?= $blog["summary"] ?></p>
        
        <?= $blog['markup'] ?>

      </article>

    </section>

	</main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'?>
</body>
<!-- <script type="text/javascript" src="../../assets/main.js"></script> -->
<script type="text/javascript" src="https://raw.githack.com/matthewLeFevre/beautiful_site/master/assets/main.js"></script>
</html>