
    <div class="container-fluid">
      <div class="page-header">
        <h1><?php echo $category->hasId() ? 'Modification d\'une catégorie' : 'Encodage d\'une catégorie' ?></h1>
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
                        <td class="key"><label for="name">Nom</label></td>
                        <td><input type="text" name="name" id="name" value="<?php echo $category->name; ?>"/></td>
                    </tr>
                    <tr>
                        <td class="key"><label for="acoUrl">ACO URL (will disappear…)</label></td>
                        <td><input type="text" name="acoUrl" id="acoUrl" value="<?php echo $category->acoUrl; ?>"/></td>
                    </tr>
                </table>
            </fieldset>

        <div class="span12">
          <input type="submit" value="submit" />
        </div>
        </form>

      </div>


    </div><!--/.fluid-container-->
