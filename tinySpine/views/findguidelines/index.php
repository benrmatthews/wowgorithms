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

function roundNumber($number) {
  if($number > 999) {
       return round($number / 1000, 1) . "k";
    }
    else {
        return $number;
    }
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
  <script src='https://www.google.com/recaptcha/api.js'></script>
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
      <span class="overlay"></span>
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
                    <?php foreach($logs as $log) : ?>
                      <li class="log__list-item">
                      <div class="log__icon" style="color: #<?= $log->brandColor ?>">
                        <?php echo file_get_contents(BASEURL."img/icons/".$log->brandSlug.".svg"); ?>
                      </div>
                      <div class="log__text">
                      <?php if($log->typeMessage == 1) : ?>
                        <span style="color:#<?= $log->brandColor ?>"><?= $log->brandName ?></span> added by <a href="#" target="_blank">[AUTHOR]</a>.
                      <?php else : ?>
                        <span style="color:#<?= $log->brandColor ?>"><?= $log->brandName ?></span> has been updated.
                      <?php endif; ?>
                        <strong>On <?= $log->date ?></strong>
                      </div>
                      </li>
                    <?php endforeach; ?>
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
    <span class="reset"></span>
  </div>
  <div class="options">
    <form action="." class="options__form">
    <label for="s">Sort by</label>
      <select name="s" id="s">
        <option value="popular" <?php if ((empty($_GET['s'])) || ($_GET['s'] == 'popular')) { echo 'selected="selected"';} ?> >Most popular</option>
        <option value="alphabetically" <?php if ((!empty($_GET['s'])) && ($_GET['s']=="alphabetically")) {echo 'selected="selected"';} ?>>Alphabetically</option>
      </select>
    </form>
  </div>
</section>

<main role="main" class="maincontent">
<?php foreach($categories as $category):

    if ((empty($_GET['s'])) || ($_GET['s'] == 'popular')) {
      $brands = $category->getAllBrandOrderByClicks(Brand::STATUS_PUBLISHED);
    } else {
      $brands = $category->getAllBrand(Brand::STATUS_PUBLISHED);
    }
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
                        <?php echo file_get_contents(BASEURL."img/icons/".$brand->slug.".svg"); ?>
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
                    <?php if ($brand->clicksCount) { 
                      echo roundNumber($brand->clicksCount); } else { echo "0"; } ?></div>
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

<div class="modal">
  <div class="modal__wrapper">
  <span class="overlay"></span>
    <div class="modal__container">
      <header class="modal__header">
        <h1 class="modal__title">Add a guideline</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque sint quis tempora, veritatis aliquid culpa, cupiditate doloremque, magni corrupti vero officia numquam sapiente quaerat! Nisi soluta, corporis voluptatibus similique deserunt?</p>
      </header>
      <form action="#" class="form">
      <div class="form-item">
          <div class="form-wrapper-item">
            <div class="label-infos">
              <label for="twittername">Twitter name</label>
              <p>Just to be added in the log part. It's not required.</p>
            </div>
            <div class="wrapper-input">
              <input type="text" name="twittername" id="twittername">
            </div>
          </div>
        </div>
        <div class="form-item">
          <div class="form-wrapper-item">
            <div class="label-infos">
              <label for="name">Brand name*</label>
            </div>
            <div class="wrapper-input">
              <input type="text" name="name" id="name">
            </div>
          </div>
        </div>
        <div class="form-item">
          <div class="form-wrapper-item">
            <div class="label-infos">
              <label for="url">Brand URL*</label>
            </div>
            <div class="wrapper-input">
              <input type="text" name="url" id="url">
            </div>
          </div>
        </div>
        <div class="form-item">
          <div class="form-wrapper-item">
            <div class="label-infos">
              <label for="brandColor">Brand color*</label>
              <p>Must be hexadecimal</p>
            </div>
            <div class="wrapper-input">
              <input type="text" name="brandColor" id="brandColor">
            </div>
          </div>
        </div>
        <div class="form-item">
          <div class="form-wrapper-item">
            <div class="label-infos">
              <label for="category">Brand's category*</label>
            </div>
            <div class="wrapper-input">
              <select name="category" id="category">
              <option value="" selected="selected">Aucune</option>
                <?php foreach($categories as $category): ?>
                  <option value="<?php echo $category->getId(); ?>"><?php echo $category->name; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="form-item">
          <div class="form-wrapper-item">
            <div class="label-infos">
              <label for="logo">Brand's logo*</label>
              <p>It has to be a SVG monochromia.</p>
            </div>
            <div class="wrapper-input">
              <input type="file">
            </div>
          </div>
        </div>
        <div class="form-item">
          <div class="form-wrapper-item">
            <div class="label-infos">
              <label for="tags">Tags</label>
              <p>Separated by commas</p>
            </div>
            <div class="wrapper-input">
              <textarea name="tags" id="tags" rows="5"></textarea>
            </div>
          </div>
        </div>
        <div class="form-item">
          <div class="form-wrapper-item">
            <div class="label-infos">
              <label for="recaptcha">Captcha</label>
            </div>
            <div class="wrapper-input">
              <div class="g-recaptcha" data-sitekey="6LfgPgoTAAAAAKveISVB3ZEWSO_3QGALby9kzyBo"></div>
            </div>
          </div>
        </div>
        <div class="form-submit">
          <div class="form-wrapper-submit">
            <button type="submit" class="btn">Submit guideline</button>
          </div>
        </div>
      </form>
      <small>* These fields are required.</small>
      <div class="close"></div>
    </div>
  </div>

</div>

<script src="<?php echo BASEURL; ?>js/jquery.min.js"></script>
<script src="<?php echo BASEURL; ?>js/main.js"></script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

</body>
</html>
