<main role="main" class="maincontent">
  <header class="header__page">
    <h1 class="page__title">Categories listing</h1>
    <div class="actions">
      <a href="<?php echo BASEURL; ?>fgl_headquarter?action=category" class="btn btn-add">add a category</a>
    </div>
  </header>
  <section class="content">
    <table class="table table-striped">
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>AcoURL</th>
          <th>Actions</th>
        </tr>
        <?php foreach($categories as $category): ?>
        <tr>
          <td><?php echo $category->getId(); ?></td>
          <td><?php echo $category->name; ?></td>
          <td><?php echo $category->acoUrl; ?></td>
          <td class="actions">
            <a href="<?php echo BASEURL.AdministrationController::DIRECTORY_ADMINISTRATION; ?>?action=category&id=<?php echo $category->getId(); ?>">Edit</a>
            <a class="deleteLink" href="<?php echo BASEURL.AdministrationController::DIRECTORY_ADMINISTRATION; ?>?action=deleteCategory&id=<?php echo $category->getId(); ?>">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
      </table>
  </section>
</main>
