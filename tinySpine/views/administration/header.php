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
