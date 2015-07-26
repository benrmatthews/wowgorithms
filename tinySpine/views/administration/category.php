<main role="main" class="maincontent">
  <header class="header__page">
    <p class="breadcrumbs">
      <a href="<?php echo BASEURL; ?>fgl_headquarter?action=categories">Categories</a> > <span class="currentPage"><?php echo $category->hasId() ? $category->name : 'New category'; ?></span>
    </p>
    <h1 class="page__title"><?php echo $category->hasId() ? 'Edit a category' : 'New category' ?></h1>
    <?php if(!empty($error)): ?>
      <div class="alert">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Error!</strong> <?php echo $error?>
      </div>
      <?php endif; ?>
  </header>
  <section class="content">
    <form method="post" enctype="multipart/form-data" class="form">
      <div class="form-item">
        <div class="form-wrapper-item">
          <div class="label-infos">
            <label for="name">Name</label>
          </div>
          <div class="wrapper-input">
            <input type="text" name="name" id="name" value="<?php echo $category->name; ?>"/>
          </div>
        </div>
      </div>
      <div class="form-item">
        <div class="form-wrapper-item">
          <div class="label-infos">
            <label for="acoUrl">ACO URL (will disappear…)</label>
          </div>
          <div class="wrapper-input">
            <input type="text" name="acoUrl" id="acoUrl" value="<?php echo $category->acoUrl; ?>"/>
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
