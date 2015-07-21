<?php 

function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
}

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<script src="//use.typekit.net/wxg3lnd.js"></script>
<script>try{Typekit.load();}catch(e){}</script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Find Guidelines - The fastest way to brand assets.</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1" />
  <meta name="description" content="Find guidelines on the web. The fastest way to brand assets.">
  <meta property="og:title" content="Find guidelines on the web. The fastest way to brand assets." />
  <meta property="og:site_name" content="Find guidelines on the web. The fastest way to brand assets." />
  <meta property="og:type" content="website"/>
  <meta property="og:url" content="http://findguidelin.es/" />
  <meta property="og:description" content="The fastest way to brand assets." />
  <meta property="og:image" content="http://findguidelin.es/img/guidelinesweb.png" />
  <link rel="icon" href="http://findguidelin.es/img/favicon.ico" />
  <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
  <script src="<?php echo BASEURL; ?>js/modernizr.js"></script>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=127527034013572";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->

<header class="mainheader">
  <div class="mainheader-wrapper">
    <section class="logo">
      <h1><a href="<?php echo BASEURL; ?>">FindGuidelin.es <em>The fastest way to brand assets.</em></a></h1>
    </section>
    <nav class="mainmenu">
      <span></span>
      <div class="sidebar__wrapper">

        <button id="access-trigger" role="widget" class="access-trigger">
          <div>
            <span class="bun"></span>
            <span class="burger"></span>
            <span class="bun"></span>
          </div>
        </button>

        <div class="sidebar__container">
          <div class="sidebar__container-overflow">
            <button class="btn btn-add">Add a guideline</button>
          
            <div class="sub-sidebar">
              <div class="sub-sidebar__container">
                <div class="sub-sidebar__container-overflow">
                  <div class="about">
                    <h1>Ahoy fellow designers&nbsp;!</h1>
                    <p>FindGuidelin.es is a simple one-page website where you can find easily and quickly the web guidelines from the most famous brands, especially social networks. It's a small collaborative project, so don't hesitate to submit yours.</p>
                  </div>
                  <div class="log">
                  <h2>Last updates</h2>
                    <ul class="log__list">
                    <?php for ($i=0; $i<20; $i++) { ?>
                      <li class="log__list-item">
                        Machin was added.
                        <strong>Added on 3rd July 2015</strong>
                      </li>
                    <?php } ?>
                    </ul>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
      
    </nav>
  </div> 
</header>
<section class="optionsPanel">
  <div class="searchform">
    <label for="searchform-input" class="searchform-label">Search</label>
    <input type="search" id="searchform-input" class="searchform-input" placeholder="Find any brand assets by typing name or tags" />
  </div>
  <div class="options">
    order by
  </div>
</section>

<main role="main" class="maincontent">
<?php foreach($categories as $category):
    $brands = $category->getAllBrandOrderByClicks();
    ?>
  <header class="header__category">
    <h1 class="maincontent__title"><?php echo $category->name; ?> </h1>
  </header>
  <div class="row">
    <ul class="grid">
    <?php foreach($brands as $brand): ?>
      <li class="grid__block" data-tags="<?= $brand->tags ?>" style="color: #<?= $brand->brandColor ?>">
        <div class="grid__block-wrappercontent">
            <div class="grid__block-container" style="background-color: #<?= $brand->brandColor ?>">
              <a href="<?= BASEURL.$brand->slug ?>" target="_blank">
                <div class="grid__block-wrapper">
                  <div class="grid__block-centered">
                    <div>
                        <img src="img/icons/<?= $brand->slug ?>.svg" alt="<?= $brand->name ?>"/>
                    </div>
                  </div>
                </div>
              </a>
              <span class="color">#<?= $brand->brandColor ?></span>
            </div>
            <div class="grid__block-infos" style="border-color: rgba(<?= hex2rgb("#".$brand->brandColor) ?>, .19)">
                <header>
                <h2 class="grid__block-title"><a href="<?= BASEURL.$brand->slug ?>" target="_blank"><?= $brand->name ?></a></h2>
                <div class="views">
                    <?php if ($brand->clicksCount) { echo $brand->clicksCount; } else { echo "0"; } ?></div>
                </header>
                <?php if ($brand->tags) : ?>
                <?php $tags = explode(", ",$brand->tags); ?>
                    <div class="tags"><?foreach ($tags as $tag) : ?>
                        <a href="#" class="tag"><?= $tag ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </li>

      <?php endforeach; ?>
    </ul>
  </div>
<?php endforeach; ?>
</main>

<div class="mainfooter__wrapper">
    <footer class="mainfooter">
        <div class="mainfooter__container">
            <p class="copyright">
                Made by <a href="https://twitter.com/aqro" target="_blank">Arno Di Nunzio</a>
            </p>
            <div class="share-module">
                <div class="tw-btn"><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://findguidelin.es/" data-via="aqro">Tweet</a></div>
                <div class="fb-like" data-href="http://findguidelin.es/" data-send="false" data-layout="button_count" data-width="200" data-show-faces="false"></div>
            </div>
        </div>
    </footer>
</div>

<script src="<?php echo BASEURL; ?>js/jquery.min.js"></script>
<script src="<?php echo BASEURL; ?>js/main.js"></script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

</body>
</html>
