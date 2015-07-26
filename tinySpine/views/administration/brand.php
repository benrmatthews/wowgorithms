<main role="main" class="maincontent">
  <header class="header__page">
    <p class="breadcrumbs">
      <a href="<?php echo BASEURL; ?>fgl_headquarter?action=brands">Brands</a> > <span class="currentPage"><?php echo $brand->hasId() ? $brand->name : 'New brand' ?></span>
    </p>
    <h1 class="page__title"><?php echo $brand->hasId() ? 'Edit a brand' : 'New brand' ?></h1>
    
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
            <label for="name">Name</label>
          </div>
          <div class="wrapper-input">
            <input type="text" name="name" id="name" value="<?php echo $brand->name; ?>"/>
          </div>
        </div>
      </div>
      <div class="form-item">
        <div class="form-wrapper-item">
          <div class="label-infos">
            <label for="slug">Slug</label>
          </div>
          <div class="wrapper-input">
            <input type="text" name="slug" id="slug" value="<?php echo $brand->slug; ?>"/>
          </div>
        </div>
      </div>
      <div class="form-item">
        <div class="form-wrapper-item">
          <div class="label-infos">
            <label for="brandColor">Brand Color</label>
          </div>
          <div class="wrapper-input">
            <input type="text" name="brandColor" id="brandColor" value="<?php echo $brand->brandColor; ?>"/>
          </div>
        </div>
      </div>
      <div class="form-item">
        <div class="form-wrapper-item">
          <div class="label-infos">
            <label for="borderColor">Border Color</label>
          </div>
          <div class="wrapper-input">
            <input type="text" name="borderColor" id="borderColor" value="<?php echo $brand->borderColor; ?>"/>
          </div>
        </div>
      </div>
      <div class="form-item">
        <div class="form-wrapper-item">
          <div class="label-infos">
            <label for="url">URL</label>
          </div>
          <div class="wrapper-input">
            <input type="text" name="url" id="url" value="<?php echo $brand->url; ?>"/>
          </div>
        </div>
      </div>
      <div class="form-item">
        <div class="form-wrapper-item">
          <div class="label-infos">
            <label for="tags">Tags</label>
          </div>
          <div class="wrapper-input">
            <input type="text" name="tags" id="tags" value="<?php echo $brand->tags; ?>"/>
          </div>
        </div>
      </div>
      <div class="form-item">
        <div class="form-wrapper-item">
          <div class="label-infos">
            <label for="category">Brand's category</label>
          </div>
          <div class="wrapper-input">
            <select name="category" id="category">
              <option value="">Aucune</option>
              <?php foreach($categories as $category): ?>
              <option value="<?php echo $category->getId(); ?>"<?php if($category->getId() == $brand->category) echo 'selected="selected"'?>><?php echo $category->name; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>
      <div class="form-item">
        <div class="form-wrapper-item">
          <div class="label-infos">
            <label for="status">Status</label>
          </div>
          <div class="wrapper-input">
            <select name="status" id="status">
              <option value="<?php echo Brand::STATUS_INVALID ?>"<?php if($brand->status == Brand::STATUS_INVALID) echo 'selected="selected"'?>>Invalide</option>
              <option value="<?php echo Brand::STATUS_PUBLISHED; ?>"<?php if($brand->status == Brand::STATUS_PUBLISHED) echo 'selected="selected"'?>>Publiée</option>
              <option value="<?php echo Brand::STATUS_REJECTED ?>"<?php if($brand->status == Brand::STATUS_REJECTED) echo 'selected="selected"'?>>Rejetée</option>
            </select>
          </div>
        </div>
      </div>
      <div class="form-item">
        <div class="form-wrapper-item">
          <div class="label-infos">
            <label for="isPDF">isPDF</label>
          </div>
          <div class="wrapper-input">
            <input type="text" name="isPDF" id="isPDF" value="<?php echo $brand->isPDF; ?>"/>
          </div>
        </div>
      </div>
      <div class="form-item">
        <div class="form-wrapper-item">
          <div class="label-infos">
            <label for="logoPNG">Logo PNG</label>
          </div>
          <div class="wrapper-input">
            <div class="icon icon-png" style="background-color: #<?= $brand->brandColor ?>">
              <img src="img/icons/<?= $brand->slug ?>.png">
            </div>
            <input type="file" name="logoPNG" id="logoPNG" value=""/>
          </div>
        </div>
      </div>
      <div class="form-item">
        <div class="form-wrapper-item">
          <div class="label-infos">
            <label for="logoSVG">Logo SVG</label>
          </div>
          <div class="wrapper-input">
          <div class="icon icon-svg" style="background-color: #<?= $brand->brandColor ?>">
              <?php echo file_get_contents(BASEURL."img/icons/".$brand->slug.".svg"); ?>
            </div>
            <input type="file" name="logoSVG" id="logoSVG" value=""/>
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
