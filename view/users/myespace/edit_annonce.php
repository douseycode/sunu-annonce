<?php

$espace = true;
include_once '../../../header.php';
include_once '../../../navbar.php';
require('../../../actions/annonces/editAnnonceAction.php');

?>


  <div class="container">
    <h1 class="mt-5">Modication annonce</h1>
    <?php
    if (isset($errorMessage)) {
    ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?= $errorMessage; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php
    }
    ?>
    <?php if(isset($image, $titre,$description, $categorie_id)): ?>
        <form class="row g-3" method="POST" enctype="multipart/form-data">
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Titre</label>
            <input type="text" class="form-control" name="titre" value="<?= $titre; ?>">
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Prix</label>
            <input type="text" class="form-control" name="prix" value="<?= $prix; ?>">
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Description</label>
            <input type="text" class="form-control" name="description" value="<?= $description; ?>">
        </div>
       
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Photo</label>
            <img class="tbimg" width="110px" height="100px" src="../../../uploads/<?= $image ?>">
            <input type="file"  class="form-control" name="img" accept="jpg,png,jpeg">
        </div>
        <div class="col-md-6">
            <label for="inputService" class="form-label">Categorie</label>
            <select class="form-control" name="categorie_id" id="inputService">
                <?php foreach ($categories as $s) : ?>
                    <option value="<?= $s['id']; ?>" <?= ($s['id'] == $categorie_id) ? 'selected' : ''; ?>>
                        <?= $s['designation']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-12">
            <button type="submit" name='envoyer' class="btn btn-primary">Modifier</button>
        </div>
    </form>
<?php endif; ?>

  </div>


<?php
include_once '../../../footer.php'
?>