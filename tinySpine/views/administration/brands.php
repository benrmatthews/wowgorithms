<main role="main" class="maincontent">
  <header class="header__page">
    <h1 class="page__title">Brands listing</h1>
    <div class="actions">
      <a href="<?php echo BASEURL; ?>fgl_headquarter?action=brand" class="btn btn-add">add a brand</a>
    </div>
    <nav class="subMenu">
      <div class="subMenu__wrapper">
        <ul class="nav">
          <li class="active">
            <a href="#">Submissions (10)</a>
          </li>
          <li><a href="#">All brands (74)</a></li>
          <li><a href="#">Refused (200)</a></li>
        </ul>
      </div>
    </nav>
  </header>
  <div class="row">
    <ul class="grid">
    <?php foreach($brands as $brand): ?>
      <li class="grid__block" data-tags="<?= $brand->tags ?>" style="color: #<?= $brand->brandColor ?>">
        <div class="grid__block-wrappercontent">
            <div class="grid__block-container" style="background-color: #<?= $brand->brandColor ?>">
              <a href="<?php echo BASEURL.AdministrationController::DIRECTORY_ADMINISTRATION; ?>?action=brand&id=<?php echo $brand->getId(); ?>">
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
                <h2 class="grid__block-title"><?= $brand->name ?></h2>
                <div class="url-wrapper">
                  <a href="<?= $brand->url ?>" target="_blank" title="<?= $brand->url ?>" class="url">URL</a>
                </div>
                </header>
                <?php if ($brand->tags) : ?>
                <?php $tags = explode(", ",$brand->tags); ?>
                    <div class="tags"><?foreach ($tags as $tag) : ?>
                        <span class="tag"><?= $tag ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="actions">
                  <a href="<?php echo BASEURL.AdministrationController::DIRECTORY_ADMINISTRATION; ?>?action=brand&id=<?php echo $brand->getId(); ?>" class="agree">Edit</a>
                  <a class="deleteLink" href="<?php echo BASEURL.AdministrationController::DIRECTORY_ADMINISTRATION; ?>?action=deleteBrand&id=<?php echo $brand->getId(); ?>">Delete</a>
                </div>
            </div>
        </div>
      </li>

    <?php endforeach; ?>
    </ul>
  </div>
</main>

    <div class="container-fluid">
      <div class="page-header">
        <h1>Listing des marques</h1>
      </div>

      <div class="row-fluid">
      <table class="table table-striped">
        <tr>
          <th>Id</th>
          <th>Nom</th>
          <th>Slug</th>
          <th>Status</th>
          <th>Categorie</th>
          <th>Actions</th>
        </tr>
        <?php foreach($brands as $brand): ?>
        <tr>
          <td><?php echo $brand->getId(); ?></td>
          <td><?php echo $brand->name; ?></td>
          <td><?php echo $brand->slug; ?></td>
          <td>
          <?php if($brand->status == Brand::STATUS_INVALID) echo '<span style="color:orange">Invalide</span>';
          elseif($brand->status == Brand::STATUS_PUBLISHED) echo '<span style="color:green">Publiée</span>';
          elseif($brand->status == Brand::STATUS_REJECTED) echo '<span style="color:red">Rejetée</span>';
          ?>
          </td>
          
          <td><?php echo $brand->categoryName; ?></td>
          <td>
            <a href="<?php echo BASEURL.AdministrationController::DIRECTORY_ADMINISTRATION; ?>?action=brand&id=<?php echo $brand->getId(); ?>">Editer</a>
            <a class="deleteLink" href="<?php echo BASEURL.AdministrationController::DIRECTORY_ADMINISTRATION; ?>?action=deleteBrand&id=<?php echo $brand->getId(); ?>">Supprimer</a>
          </td>
        </tr>
      <?php endforeach; ?>
      </table>
      </div>
