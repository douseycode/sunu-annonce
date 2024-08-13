<?php
require('../../../actions/users/createUserAction.php');
$user = true;
include_once '../../../header.php';
include_once '../../../navbar.php';
require '../../../actions/auth/securityAdmin.php';
include_once '../../../Database/profil_db.php';
$profils = getAllProfil();
?>

<!-- Begin page content -->

    <div class="container">
        <h1 class="mt-5">Nouveau Utilisateur</h1>
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
        <form class="row g-3" method="POST" enctype="multipart/form-data">
        <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Photo</label>
                <input type="file" required class="form-control" name="img">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Prénom</label>
                <input type="text" class="form-control" name="prenom">
            </div>
            <div class="col-6">
                <label for="inputAddress2" class="form-label">Date de naissance</label>
                <input type="date" class="form-control" name="dateNai">
            </div>
            <div class="col-6">
                <label for="inputAddress" class="form-label">Email</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="col-6">
                <label for="inputAddress2" class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="col-6">
                <label for="inputAddress2" class="form-label">Telephone</label>
                <input type="tel" class="form-control" name="tel">
            </div>
            
            
            <div class="col-6">
                <label for="inputState" class="form-label">Type de profil</label>
                <select id="inputState" class="form-control" name="profil_id">
                    <option selected value="0">Séléctionner...</option>
                    <?php while ($profil = $profils->fetch(PDO::FETCH_OBJ)) : ?>
                        <option value="<?= $profil->id ?>"><?= $profil->designation ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            
            <div class="col-6">
                <button type="submit" style="margin-top: 5%;" class="btn btn-primary" name="envoyer">Créer</button>
            </div>
        </form>
    </div>


<?php
include_once '../../../footer.php'
?>