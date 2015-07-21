    <div class="container-fluid">
      <div class="page-header">
        <h1><?php echo $brand->hasId() ? 'Modification d\'une marque' : 'Encodage d\'une marque' ?></h1>
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
                        <td><input type="text" name="name" id="name" value="<?php echo $brand->name; ?>"/></td>
                    </tr>
                    <tr>
                        <td class="key"><label for="brandColor">Couleur de la marque</label></td>
                        <td><input type="text" name="brandColor" id="brandColor" value="<?php echo $brand->brandColor; ?>"/></td>
                    </tr>
                    <tr>
                        <td class="key"><label for="borderColor">Couleur de la bordure</label></td>
                        <td><input type="text" name="borderColor" id="borderColor" value="<?php echo $brand->borderColor; ?>"/></td>
                    </tr>
                    <tr>
                        <td class="key"><label for="slug">slug</label></td>
                        <td><input type="text" name="slug" id="slug" value="<?php echo $brand->slug; ?>"/></td>
                    </tr>
                    <tr>
                        <td class="key"><label for="url">url</label></td>
                        <td><input type="text" name="url" id="url" value="<?php echo $brand->url; ?>"/></td>
                    </tr>
                    <tr>
                        <td class="key"><label for="tags">tags</label></td>
                        <td><input type="text" name="tags" id="tags" value="<?php echo $brand->tags; ?>"/></td>
                    </tr>

                    <tr>
                        <td class="category"><label for="category">category</label></td>
                        <td>
                          <select name="category" id="category">
                            <option value="">Aucune</option>
                          <?php foreach($categories as $category): ?>
                            <option value="<?php echo $category->getId(); ?>"<?php if($category->getId() == $brand->category) echo 'selected="selected"'?>><?php echo $category->name; ?></option>
                          <?php endforeach; ?>
                          </select>
                    </tr>

                    <tr>
                        <td class="key"><label for="isPDF">isPDF</label></td>
                        <td><input type="text" name="isPDF" id="isPDF" value="<?php echo $brand->isPDF; ?>"/></td>
                    </tr>
                    
                    <tr>
                    	<td class="key"><label for="logoPNG">Logo (PNG) </label></td>
                    	<td><input type="file" name="logoPNG" id="logoPNG" value=""/></td>
                    </tr>
                    
                    <tr>
                    	<td class="key"><label for="logoSVG">Logo (SVG)</label></td>
                    	<td><input type="file" name="logoSVG" id="logoSVG" value=""/></td>
                    </tr>

                </table>
            </fieldset>

        <div class="span12">
          <input type="submit" value="submit" />
        </div>
        </form>

      </div>


    </div><!--/.fluid-container-->
