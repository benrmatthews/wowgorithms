
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
          <th>Categorie</th>
          <th>Actions</th>
        </tr>
        <?php foreach($brands as $brand): ?>
        <tr>
          <td><?php echo $brand->getId(); ?></td>
          <td><?php echo $brand->name; ?></td>
          <td><?php echo $brand->slug; ?></td>
          <td><?php echo $brand->categoryName; ?></td>
          <td>
            <a href="<?php echo BASEURL.AdministrationController::DIRECTORY_ADMINISTRATION; ?>?action=brand&id=<?php echo $brand->getId(); ?>">Editer</a>
            <a class="deleteLink" href="<?php echo BASEURL.AdministrationController::DIRECTORY_ADMINISTRATION; ?>?action=deleteBrand&id=<?php echo $brand->getId(); ?>">Supprimer</a>
          </td>
        </tr>
      <?php endforeach; ?>
      </table>
      </div>
