<?php

require '../../header.php';
// require '../../navbar.php';
require '../../actions/auth/registerAction.php';

?>



<main class="flex-shrink-0">
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 mt-4">
            <div class="signup-form">
                <form action="" class="mt-5 border p-4 bg-light shadow"  method="post" enctype="multipart/form-data">
               

                    
                    <h4 class="mb-5 text-secondary">Creer un compte</h4>
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
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label>Prenom<span class="text-danger">*</span></label>
                            <input type="text" name="prenom" class="form-control" >
                        </div>

                        <div class="mb-3 col-md-6">
                            <label>Nom<span class="text-danger">*</span></label>
                            <input type="text" name="nom" class="form-control" >
                        </div>

                        <div class="mb-3 col-md-12">
                            <label>Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" >
                        </div>
                      

                        <div class="mb-3 col-md-12">
                            <label>Telephone<span class="text-danger">*</span></label>
                            <input type="tel" name="tel" class="form-control" >
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Date naissance<span class="text-danger">*</span></label>
                            <input type="date" name="dateNai" class="form-control" >
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Mot de psse<span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" >
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Confimer le mot de psse<span class="text-danger">*</span></label>
                            <input type="password" name="confirmpassword" class="form-control" >
                        </div>
                       
                        <div class="mb-3 col-md-12">
                            <label>Image de profil<span class="text-danger">*</span></label>
                            <input type="file" name="img" class="form-control">
                        </div>
                        <div class="col-md-12">
                           <button name="envoyer" class="btn btn-primary float-end">S'inscrire</button>
                        </div>
                    </div>
                </form>
                <p class="text-center mt-3 text-secondary">Si vous avez un compte, veuillez, vous  <a href="login.php">conneter</a></p>
            </div>
        </div>
    </div>
</div>
</main>


<?php require '../../footer.php'; ?>