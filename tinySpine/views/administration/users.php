<main role="main" class="maincontent">
  <header class="header__page">
    <h1 class="page__title">Categories listing</h1>
    <div class="actions">
      <a href="<?php echo BASEURL; ?>fgl_headquarter?action=user" class="btn btn-add">add a user</a>
    </div>
  </header>
  <section class="content">
    <table class="table table-striped">
        <tr>
          <th>Firstname</th>
          <th>Lastname</th>
          <th>Login</th>
          <th>Actions</th>
        </tr>
        <?php foreach($usersData as $userData): ?>
        <tr>
          <td><?php echo $userData['firstName']; ?></td>
          <td><?php echo $userData['lastName']; ?></td>
          <td><?php echo $userData['login']; ?></td>
          <td class="actions">
            <a href="<?php echo BASEURL.AdministrationController::DIRECTORY_ADMINISTRATION; ?>?action=user&id=<?php echo $userData['id']; ?>">Edit</a>
            <a class="deleteLink" href="<?php echo BASEURL.AdministrationController::DIRECTORY_ADMINISTRATION; ?>?action=deleteUser&id=<?php echo $userData['id']; ?>">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
      </table>
  </section>
</main>