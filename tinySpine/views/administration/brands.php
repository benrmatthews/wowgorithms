
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
