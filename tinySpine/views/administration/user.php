
    <div class="container-fluid">
      <div class="page-header">
        <h1><?php echo $user->hasId() ? 'Modification d\'un utilisateur' : 'Encodage d\'un utilisateur' ?></h1>
      </div>
      <?php if(!empty($error)): ?>
      <div class="alert">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Erreur!</strong> <?php echo $error?>
      </div>
      <?php endif; ?>

      <div class="row-fluid">
        <form method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Informations</legend>
                <table class="table table-striped">
                    <tr>
                        <td class="key"><label for="firstName">Prénom</label></td>
                        <td><input type="text" name="firstName" id="firstName" value="<?php echo $user->firstName; ?>"/></td>
                    </tr>
                    <tr>
                        <td class="key"><label for="lastName">Nom</label></td>
                        <td><input type="text" name="lastName" id="lastName" value="<?php echo $user->lastName; ?>"/></td>
                    </tr>
                    <tr>
                        <td class="key"><label for="login">Identifiant</label></td>
                        <td><input type="text" name="login" id="login" value="<?php echo $user->login; ?>"/></td>
                    </tr>
                    <tr>
                        <td class="key"><label for="password">Mot de passe</label></td>
                        <td><input type="text" name="password" id="password" value=""/>
                            <p>Laissez ce champ vide sauf si vous voulez changer le mot de passe de l'utilisateur</p>
                        </td>
                    </tr>

                </table>
            </fieldset>

        <div class="span12">
          <input type="submit" value="submit" />
        </div>
        </form>

      </div>


    </div><!--/.fluid-container-->
