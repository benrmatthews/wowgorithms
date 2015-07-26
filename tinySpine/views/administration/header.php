<?php  /* ?>
<div class="navbar">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="<?= BASEURL ?>fgl_headquarter/">Findguidelin.es</a>
          <?php if($user): ?>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              <?php echo $user->getCompleteName(); ?> (<a href="<?php echo $disconnectLink; ?>" class="navbar-link">Déconnexion</a>)
            </p>
            <ul class="nav">
              <li><a href="<?php echo $brandsLink; ?>">Marques</a></li>
              <li><a href="<?php echo $brandLink; ?>">Ajouter une marque</a></li>
              <li><a href="<?php echo $usersLink; ?>">Utilisateurs</a></li>
              <li><a href="<?php echo $userLink; ?>">Ajouter un utilisateur</a></li>
              <li><a href="<?php echo $categoriesLink; ?>">Catégories</a></li>
              <li><a href="<?php echo $categoryLink; ?>">Ajouter une catégorie</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        <?php endif; ?>
        </div>
      </div>
    </div>
*/ ?>

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

<header class="mainheader">
  <div class="mainheader-wrapper">
    <section class="logo">
      <h1><a href="<?php echo BASEURL; ?>">FindGuidelin.es</a> <a href="<?php echo BASEURL; ?>fgl_headquarter/">/ Admin</a></h1>
    </section>
    <nav class="mainmenu">
      <div class="sidebar__wrapper">

        <?php if($user): ?>
        <ul class="nav">
          <li <?php echo (($_GET['action']=='brands') || ($_GET['action']=='brand')) ? 'class="active"' : ''; ?>><a href="<?php echo $brandsLink; ?>">Brands</a></li>
          <!-- <li><a href="<?php echo $brandLink; ?>">Ajouter une marque</a></li> -->
          <li <?php echo (($_GET['action']=='categories') || ($_GET['action']=='category')) ? 'class="active"' : ''; ?>><a href="<?php echo $categoriesLink; ?>">Categories</a></li>
          <!-- <li><a href="<?php echo $categoryLink; ?>">Ajouter une catégorie</a></li> -->
          <li <?php echo (($_GET['action']=='users') || ($_GET['action']=='user')) ? 'class="active"' : ''; ?>><a href="<?php echo $usersLink; ?>">Users</a></li>
          <!-- <li><a href="<?php echo $userLink; ?>">Ajouter un utilisateur</a></li> -->
          <li>/</li>
          <li><?php //echo $user->getCompleteName(); ?> <a href="<?php echo $disconnectLink; ?>" class="disconnect">Disconnect</a></li>
        </ul>
        <?php endif; ?>
      </div>
      
    </nav>
  </div> 
</header>