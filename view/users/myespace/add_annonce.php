<?php

require '../../../header.php';
require '../../../navbar.php';
require '../../../actions/auth/securityAction.php';
require('../../../actions/annonces/createAnnconceAction.php');
include_once '../../../Database/categorie_db.php';
$categories = getAllCategorie();

?>



<section class="advt-post bg-gray py-5">
    <div class="container">
        <form  method="POST" enctype="multipart/form-data">
            <!-- Post Your ad start -->
            <fieldset class="border border-gray px-3 px-md-4 py-4 mb-5">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Publier Annonce</h3>
                    </div>
                    <?php
							if (isset($message)) {
							?>
								<div class="alert alert-warning alert-dismissible fade show" role="alert">
									<?= $message; ?>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							<?php
							}

							?>
                    <div class="col-lg-6">
                        <h6 class="font-weight-bold pt-4 pb-1">Prix:</h6>
                        <input type="number" class="form-control bg-white" placeholder="Prix de l'annonce" name="prix" required>

                        <h6 class="font-weight-bold pt-4 pb-1">Titre de l'annonce:</h6>
                        <input type="text" class="form-control bg-white" placeholder="Titre de l'annonce" name="titre" required>
                        
                        <h6 class="font-weight-bold pt-4 pb-1">Description:</h6>
                        <textarea name="description" id="" class="form-control bg-white" rows="7"
                            placeholder="Écrivez les détails de votre annonce" required></textarea>
                    </div>
                    <div class="col-lg-6">
                        <h6 class="font-weight-bold pt-4 pb-1">Sélectionnez la catégorie:</h6>
                        <select name="categorie_id" class="form-control w-100 bg-white"  required>
                            <option value="0">Sélectionnez une catégorie</option>
                            <?php while ($categorie = $categories->fetch(PDO::FETCH_OBJ)) : ?>
                                <option value="<?= $categorie->id ?>"><?= $categorie->designation ?></option>
                            <?php endwhile; ?>
                        </select>
                    
                        <div class="choose-file text-center my-4 py-4 rounded bg-white">
                        <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Photo</label>
                <input type="file" required class="form-control" name="img">
            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <!-- Post Your ad end -->

            <!-- submit button -->
            <button type="submit" class="btn btn-primary d-block mt-2" name="envoyer">Poster Votre Annonce</button>
        </form>
    </div>
</section>




<?php require '../../../footer.php'; ?>