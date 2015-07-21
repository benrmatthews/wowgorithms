
    <div class="container-fluid">
      <div class="page-header">
        <h1>Listing des utilisateurs</h1>
      </div>

      <div class="row-fluid">
      <table class="table table-striped">
        <tr>
          <th>Prénom</th>
          <th>Nom</th>
          <th>Identifiant</th>
          <th>Actions</th>
        </tr>
        <?php foreach($usersData as $userData): ?>
        <tr>
          <td><?php echo $userData['firstName']; ?></td>
          <td><?php echo $userData['lastName']; ?></td>
          <td><?php echo $userData['login']; ?></td>
          <td>
            <a href="<?php echo BASEURL.AdministrationController::DIRECTORY_ADMINISTRATION; ?>?action=user&id=<?php echo $userData['id']; ?>">edit</a>
            <a class="deleteLink" href="<?php echo BASEURL.AdministrationController::DIRECTORY_ADMINISTRATION; ?>?action=deleteUser&id=<?php echo $userData['id']; ?>">delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
      </table>
      </div>
