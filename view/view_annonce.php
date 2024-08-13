<?php

require '../header.php';

require '../navbar.php';
include '../Database/annonce_db.php';
include '../actions/annonces/voirAnnonceAction.php';


?>

<section class="section bg-gray">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<!-- Left sidebar -->
			<div class="col-lg-8">
				<div class="product-details">
					<h1 class="product-title"><?= $titre ?></h1>
					<div class="product-meta">
						<ul class="list-inline">
							<li class="list-inline-item"><i class="fa fa-user-o"></i> By <?= $prenom ?></li>
							<li class="list-inline-item"><i class="fa fa-folder-open-o"></i> Categorie : <?= $categorie ?></li>
							
						</ul>
					</div>

					<!-- product slider -->
					<div class="product-slider">
						<div class="product-slider-item my-4">

							<img class="img-fluid w-100" src="../uploads/<?= $image ?>" style="width: 600px; height: 400px;">
						</div>
						<div class="content pt-3">
                            <div class="tab-content"  id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <h3 class="tab-title">Description</h3>
                                    <p><?= $description ?></p>

                                </div>
                                
                            </div>
                        </div>
                        
					</div>
					
				</div>
			</div>
			<div class="col-lg-4">
				<div class="sidebar">
				<div class="widget price text-center">
						<h4>Prix</h4>
						<p><?= $prix ?> FCFA</p>
					</div>
					
					<!-- User Profile widget -->
					
					<div class="widget user text-center">
						<img class="rounded-circle img-fluid mb-5 px-5"  src="../assets/<?= $photo ?>" alt="">
						<h4><?= $prenom . " " . $nom ?></h4>
						
					</div>
					
					<!-- Safety tips widget -->
					<div class="widget disclaimer">
						<h5 class="widget-header">Conseils de sécurité</h5>
						<ul>
							<li>Rencontrer le vendeur dans un lieu public</li>
							<li>Vérifiez l'article avant d'acheter</li>
							<li>Payez seulement après avoir récupéré l'article</li>
						</ul>
					</div>
					

				</div>
			</div>

		</div>
	</div>
	<!-- Container End -->
</section>