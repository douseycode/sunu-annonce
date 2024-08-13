<?php
require('../../../actions/users/editUserAction.php');
$user = true;
include_once '../../../header.php';
require '../../../actions/auth/securityAdmin.php';

include_once '../../../navbar.php'

?>


  <div class="container">
    <h1 class="mt-5">Modication User</h1>
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
    <?php if(isset($nom,$prenom,$email,$photo,$profil_id)): ?>
    <form class="row g-3" method="POST" enctype="multipart/form-data">
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Nom</label>
            <input type="text" class="form-control" name="nom" value="<?= $nom; ?>">
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Prenom</label>
            <input type="text" class="form-control" name="prenom" value="<?= $prenom; ?>">
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?= $email; ?>">
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Tel</label>
            <input type="tel" class="form-control" name="tel" value="<?= $tel; ?>">
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Date de naissance</label>
            <input type="date" class="form-control" name="dateNai" value="<?= $dateNai; ?>">
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Photo</label>
            <img class="tbimg" width="110px" height="100px" src="../../../assets/<?= $photo ?>">
            <input type="file" value="<?= $photo ?>" class="form-control" name="img" accept="jpg,png,jpeg">
        </div>
        <div class="col-md-6">
            <label for="inputService" class="form-label">Profil</label>
            <select class="form-select" name="profil_id" id="inputService">
                <?php foreach ($profils as $s) : ?>
                    <option value="<?= $s['id']; ?>" <?= ($s['id'] == $profil_id) ? 'selected' : ''; ?>>
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