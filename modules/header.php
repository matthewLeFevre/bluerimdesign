<?php 
  if( isset($_SESSION['loggedin'])) {
    if($_SESSION['loggedin'] == TRUE) {
      $profile = "<li class='bs-nav--item'><a class='bs-nav--link' href=''>". $_SESSION['userData']['name'] ."</a></li>";
      $logout  = "<li class='bs-nav--item'><a class='bs-nav--link' href='/controllers/ctrl-auth.php?action=logout_process'>Sign Out</a></li>";
      if($_SESSION['userData']['status'] == 'moderator' || $_SESSION['userData']['status'] == 'admin') {
        $dash = "<li class='bs-nav--item'><a class='bs-nav--link' href=''>Dashboard</a></li>";
      }
    }
  } else {
    $donate = '<li class="bs-nav--item"><a onclick="goog_report_conversion()" href="#" class="bs-btn donate-btn-link"><form class="donate-btn-styles" style="width: 100px;" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="display:inline;">
      <input type="hidden" name="cmd" value="_s-xclick">
      <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----MIIHPwYJKoZIhvcNAQcEoIIHMDCCBywCAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYA6mPPkJB/vX+B1cRPVDMThS4yWwV1KTCXlxRh5BpNUWPu0OVf14TW5wsjzTDVcKwt82l3uCGpRvr7awMqARDMjJW5gTZq5BypMLdxwutWHbs67tZEhunfX0e/54wlyJeOTF7ehfYlTyLfns73cqfhEvXwn1maNhs3cLWPFQtOlVDELMAkGBSsOAwIaBQAwgbwGCSqGSIb3DQEHATAUBggqhkiG9w0DBwQIBP3vJBe5G1OAgZh5kxiMzAUhXRv5qmwVV6PaYKIjHwxtwIDpIFAfVrIKuEEy5V8VbujIgyq76HgRhsHAMD4miH/PYf2mx6BJUV/ZbqzCRGgVjBDdlL3i6OOxTguWaxJDMZYF09EH1k68ElHyTlSC+s0OcBHfLG5g/EXujMYT3Sjnz3uygyfD/xn/JvsubUi2iCLC75+W9XwtoicJGlgpIk7WRqCCA4cwggODMIIC7KADAgECAgEAMA0GCSqGSIb3DQEBBQUAMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbTAeFw0wNDAyMTMxMDEzMTVaFw0zNTAyMTMxMDEzMTVaMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbTCBnzANBgkqhkiG9w0BAQEFAAOBjQAwgYkCgYEAwUdO3fxEzEtcnI7ZKZL412XvZPugoni7i7D7prCe0AtaHTc97CYgm7NsAtJyxNLixmhLV8pyIEaiHXWAh8fPKW+R017+EmXrr9EaquPmsVvTywAAE1PMNOKqo2kl4Gxiz9zZqIajOm1fZGWcGS0f5JQ2kBqNbvbg2/Za+GJ/qwUCAwEAAaOB7jCB6zAdBgNVHQ4EFgQUlp98u8ZvF71ZP1LXChvsENZklGswgbsGA1UdIwSBszCBsIAUlp98u8ZvF71ZP1LXChvsENZklGuhgZSkgZEwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tggEAMAwGA1UdEwQFMAMBAf8wDQYJKoZIhvcNAQEFBQADgYEAgV86VpqAWuXvX6Oro4qJ1tYVIT5DgWpE692Ag422H7yRIr/9j/iKG4Thia/Oflx4TdL+IFJBAyPK9v6zZNZtBgPBynXb048hsP16l2vi0k5Q2JKiPDsEfBhGI+HnxLXEaUWAcVfCsQFvd2A1sxRr67ip5y2wwBelUecP3AjJ+YcxggGaMIIBlgIBATCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwCQYFKw4DAhoFAKBdMBgGCSqGSIb3DQEJAzELBgkqhkiG9w0BBwEwHAYJKoZIhvcNAQkFMQ8XDTE4MDIwODE3MTY0NFowIwYJKoZIhvcNAQkEMRYEFPTT+d+Jpvj1fy0x3pQOPsp+uDYXMA0GCSqGSIb3DQEBAQUABIGAa/O3d5Mo7xSTH+usMmtL8VTltqUo9RTLnggM/ICRhxS0PveTmTnvk3E58to2QzOXVisRotknLZ/5fen7AfBNxhN4M78a4J7SEKLD0pW90FlEokGf6aTvggTwtNN6Omwnpt6QRgOZThhySCjG1oBt5LtgB6K/NsQpbfcKeZAw9JA=-----END PKCS7-----">
      <input id="img-btn-paypal" type="image" style="visibility: hidden; width: 0px;"  border="0" name="submit" alt="< Donate/>">
      <label for="img-btn-paypal" class="donate-btn-styles"> <img class="bs-img__ico" src="/img/heart.svg">&nbsp; Donate</label>
      <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form></a></li>';
  }
?>

<header class="bs-hdr__nav-left">
  <div class="bs-hdr--badge">
    <a class="brd-logo bs-lnk__hed" title="Go to the home page" href="/?action=home">&ltDesign/&gt</a>
    <div class="bs-nav--btn-panel" id="js-menu-btn">
      <div class="bs-nav--btn"></div>
    </div>
  </div>
  <nav class="bs-nav--basic" id="js-bs-nav">
    <ul class="bs-nav--item-list">
      <li class="bs-nav--item"><a class="bs-nav--link" href="/?action=archive">Archive</a></li>
      <li class="bs-nav--item"><a class="bs-nav--link" href="/?action=about">About</a></li>
      <li class="bs-nav--item"><a class="bs-nav--link" href="/?action=participate">Participate</a></li>
      <?php 
        if(isset($profile)){ echo($profile);}
        if(isset($dash)){ echo($dash);}
        if(isset($logout)){ echo($logout);}
        if(isset($donate)){echo($donate);}
      ?>
    </ul>
  </nav>
</header>