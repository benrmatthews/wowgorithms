    <div class="container-fluid">
      <div class="page-header">
        <h1>Listing des catégories</h1>
      </div>

      <div class="row-fluid">
      <table class="table table-striped">
        <tr>
          <th>Id</th>
          <th>Nom</th>
          <th>AcoURL</th>
          <th>Actions</th>
        </tr>
        <?php foreach($categories as $category): ?>
        <tr>
          <td><?php echo $category->getId(); ?></td>
          <td><?php echo $category->name; ?></td>
          <td><?php echo $category->acoUrl; ?></td>
          <td>
            <a href="<?php echo BASEURL.AdministrationController::DIRECTORY_ADMINISTRATION; ?>?action=category&id=<?php echo $category->getId(); ?>">Editer</a>
            <a class="deleteLink" href="<?php echo BASEURL.AdministrationController::DIRECTORY_ADMINISTRATION; ?>?action=deleteCategory&id=<?php echo $category->getId(); ?>">Supprimer</a>
          </td>
        </tr>
      <?php endforeach; ?>
      </table>
      </div>
