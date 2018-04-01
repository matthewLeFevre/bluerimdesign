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
	<title>Login | BlueRimDesign.com</title>
	<link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
  <!-- <link href="../../assets/main.css" rel="stylesheet" type="text/css"> -->
  <link rel="stylesheet" href="https://rawcdn.githack.com/matthewLeFevre/beautiful_site/master/dist/bs-min-0.0.1.css">
  <link rel="stylesheet" href="/styles.css">
</head>

<body>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'?>

	<main>
    <section class="bs-s__full bs-flex-center bgi-glasses">
      <form action="/controllers/ctrl-auth.php" method="POST" class="bs-form__sml brd-blur-background">
        <div class="bs-form--set">
          <h2 class="bs-hed__scd bs-mod">Login</h2>
        </div>
        <div class="bs-form--set">
          <label class="bs-lbl__txt bs-mdm">Email/Username</label>
          <input name="userIdentity" class="bs-ipt__txt__full bs-mid" type="text">
        </div>
        <div class="bs-form--set">
          <label class="bs-lbl__txt bs-mdm">Password</label>
          <input name="password" class="bs-ipt__txt__full bs-mid" type="text">
        </div>
        <div class="bs-form--set">
          <input type="hidden" name="action" value="login_process">
          <button class="bs-btn bs-main" type="submit">Sign In</button>
          <a href="/controllers/ctrl-auth.php?action=register_view" class="bs-btn bs-main">Sign Up</a>
        </div>
      </form>
    </section>
	</main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'?>
</body>
<!-- <script type="text/javascript" src="../../assets/main.js"></script> -->
<script type="text/javascript" src="https://raw.githack.com/matthewLeFevre/beautiful_site/master/assets/main.js"></script>
</html>