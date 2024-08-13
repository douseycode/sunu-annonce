<?php

require '../../../header.php';
require '../../../actions/auth/securityAction.php';
require '../../../navbar.php';
require '../../../Database/annonce_db.php';
$user_id = $_SESSION['id'];
$annonces = getAnnonceId($user_id);

?>

<section class="dashboard section">
	<!-- Container Start -->
	<div class="container">
		<!-- Row Start -->
		<div class="row">
			<div class="col-lg-4">
				<div class="sidebar">
					
					
					<!-- Dashboard Links -->
					<div class="widget user-dashboard-menu">
						<ul>
							<li class="active">
								<a href="my_annonce.php"><i class="fa fa-user"></i> Mes Annonce</a>
							</li>
							
							<li>
								<a href="annonce-rejeter.php"><i class="fa fa-trash"></i></i> Annonce Rejeter</a>
							</li>
							
						
						</ul>
					</div>

					<!-- delete-account modal -->
					<!-- delete account popup modal start-->


				</div>
			</div>
			<div class="col-lg-8">
    <!-- Recently Favorited -->
    <div class="widget dashboard-container my-adslist">
        <h3 class="widget-header">Mes Annonces</h3>
        <?php if ($annonces->rowCount() > 0) : ?>
            <table class="table table-responsive product-dashboard-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Titre</th>
                        <th class="text-center">Categorie</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($annonce = $annonces->fetch()) : ?>
                        <tr>
                            <td class="product-thumb">
                                <img width="80px" height="auto" src="../../../uploads/<?= $annonce['image'] ?>" alt="image description"></td>
                            <td class="product-details">
                                <h3 class="title"><?= $annonce['titre'] ?></h3>
                                <span class="add-id"><strong>Prix:</strong> <?= $annonce['prix'] ?> FCFA</span>
                                <span><strong>Date publication: </strong><time><?= $annonce['date_creation'] ?></time> </span>
                                <span class="status active"><strong>Status</strong><?= $annonce['etat'] ?></span>
                                
                            </td>
                            <td class="product-category"><span class="categories"><?= $annonce['categorie_name'] ?></span></td>
                            <td class="action" data-title="Action">
                                <div class="">
                                    <ul class="list-inline justify-content-center">
                                        <?php if($annonce['etat']!== 'REJETEE') : ?>
                                        <li class="list-inline-item">
                                            <a data-toggle="tooltip" data-placement="top" title="View" class="view" href="/view/view_annonce.php?id=<?= $annonce['id'] ?>">
                                                <i class="fa fa-eye"></i>
                                            </a>
										</li>
                                        <?php endif; ?>
                                        <li class="list-inline-item">
                                            <a data-toggle="tooltip" data-placement="top" title="Edit" class="edit" href="edit_annonce.php?id=<?= $annonce['id'] ?>">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                           
                                            <a   data-toggle="modal" data-placement="top" title="Delete" class="delete" data-target="#deleteaccount<?= $annonce['id'] ?>">
                                            <i class="fa fa-trash"></i>
                                            </a>  
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteaccount<?= $annonce['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <img src="images/account/Account1.png" class="img-fluid mb-2" alt="">
        <h6 class="py-2">Êtes-vous sûr de vouloir supprimer votre annonce ?</h6>
        
      </div>
      <div class="modal-footer border-top-0 mb-3 mx-5 justify-content-center">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
        <!-- <button type="button"  class="btn btn-danger">Delete</button> -->
        <a href="/actions/annonces/deleteAnnonceAction.php?id=<?= $annonce['id'] ?>" type="button" class="btn btn-danger">Oui</a>
      </div>
    </div>
  </div>
</div>
                    <?php endwhile; ?>
                </tbody>
            </table>
            
        <?php else : ?>
            <p>Aucune annonce à afficher.</p>
        <?php endif; ?>
    </div>
    
</div>


		</div>
		
	</div>

	
</section>
<?php require '../../../footer.php'; ?>