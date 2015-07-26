<main role="main" class="maincontent">
  <header class="header__page">
    <p class="breadcrumbs">
      <a href="<?php echo BASEURL; ?>fgl_headquarter?action=users">Users</a> > <span class="currentPage"><?php echo $user->hasId() ? $user->firstName.' '.$user->lastName : 'Encodage d\'un utilisateur'; ?></span>
    </p>
    <h1 class="page__title"><?php echo $user->hasId() ? 'Modification d\'un utilisateur' : 'Encodage d\'un utilisateur' ?></h1>
    <?php if(!empty($error)): ?>
      <div class="alert">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Erreur!</strong> <?php echo $error?>
      </div>
      <?php endif; ?>
  </header>
  <section class="content">
    <form method="post" enctype="multipart/form-data" class="form">
      <div class="form-item">
        <div class="form-wrapper-item">
          <div class="label-infos">
            <label for="firstName">Firstname</label>
          </div>
          <div class="wrapper-input">
            <input type="text" name="firstName" id="firstName" value="<?php echo $user->firstName; ?>"/>
          </div>
        </div>
      </div>

      <div class="form-item">
        <div class="form-wrapper-item">
          <div class="label-infos">
            <label for="lastName">Lastname</label>
          </div>
          <div class="wrapper-input">
            <input type="text" name="lastName" id="lastName" value="<?php echo $user->lastName; ?>"/>
          </div>
        </div>
      </div>

      <div class="form-item">
        <div class="form-wrapper-item">
          <div class="label-infos">
            <label for="login">Login</label>
          </div>
          <div class="wrapper-input">
            <input type="text" name="login" id="login" value="<?php echo $user->login; ?>"/>
          </div>
        </div>
      </div>

      <div class="form-item">
        <div class="form-wrapper-item">
          <div class="label-infos">
            <label for="password">Password</label>
            <p>Let this field empty except if you want to change the user's password.</p>
          </div>
          <div class="wrapper-input">
            <input type="text" name="password" id="password" value="<?php echo $user->password; ?>"/>
          </div>
        </div>
      </div>
      
      <div class="form-submit span12">
        <div class="form-wrapper-submit">
          <input type="submit" value="submit" class="btn"/>
        </div>
      </div>
    </form>
  </section>
</main>
