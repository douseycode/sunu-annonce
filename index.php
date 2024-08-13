<?php
require 'header.php';
require 'navbar.php';
require('./Database/annonce_db.php');
require('./Database/categorie_db.php');

include './actions/annonces/searchAnnonceAction.php';
    
    $annonces = getAllAnnonces();

 

?>

<style>
    .fixed-size-image {
    width: 300px; 
    height: 200px; 
    /* object-fit: cover;  */
}

</style>


<section class="page-search">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Advance Search -->
				<div class="advance-search nice-select-white">
					<form method="get">
						<div class="form-row align-items-center">
							<div class="col-md-8">
							<input type="search" placeholder="Rechercher une annonce" name="search" class="form-control">
							</div>
							<div class="form-group col-xl-2 col-lg-3 col-md-6">
								<button type="submit" name="send" class="btn btn-primary active w-100">Rechercher</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section-sm">
	<div class="container">
		<div class="row">
        <?php
                    if ($searchResults && $searchResults->rowCount() > 0) { ?>
			<div class="col-md-12">
				<div class="search-result bg-gray">
                    
					<h2>Resultat pour "<?= $word ?>"</h2>
				
				</div>
			</div>
            <?php } ?>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-4">
				<div class="category-sidebar">
					<div class="widget category-list">
						<h4 class="widget-header">Categories</h4>
						<ul class="category-list">
							<?php
								$categories = getAllCategorie();
								foreach ($categories as $categorie) {
									echo '<li><a href="?categorieId=' . $categorie['id'] . '">' . $categorie['designation'] .'</a></li>';
								}
							?>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-9 col-md-8">
				
            <div class="row mt-30">
    <?php
    if ($searchResults && $searchResults->rowCount() > 0) {
        while ($result = $searchResults->fetch()) {
    ?>
            <div class="col-lg-4 col-md-6">
                <!-- Résultat de la recherche -->
                <div class="product-item bg-light">
                    <div class="card">
                        <div class="thumb-content">
                            <a >
                                <img class="card-img-top img-fluid" src="uploads/<?= $result['image'] ?>">
                            </a>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><a><?= $result['titre'] ?></a></h4>
                            <ul class="list-inline product-meta">
                                <li class="list-inline-item">
                                    <a href=""><i class="fa fa-folder-open-o"></i><?= $result['categorie_name'] ?></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href=""><i class="fa fa-calendar"></i><?= $result['date_creation'] ?></a>
                                </li>
                            </ul>
                            <p class="card-text"><?= $result['prenom'] . ' ' . $result['nom'] ?></p>
                            <a href="view/view_annonce.php?id=<?= $result['id'] ?>" class="btn btn-primary">Voir Détail</a>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    } elseif (isset($word)) {
    ?>
        <div class="col">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Aucun résultat trouvé !
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php
    }
    ?>
</div>

                
				<div class="product-grid-list">
                <?php
if (isset($_GET['categorieId'])) {
    $categorieId = $_GET['categorieId'];
    $annonces = getAnnoncesByCategorie($categorieId);

    if (!empty($annonces)) {
        foreach ($annonces as $annonce) {
            echo '<div class="ad-listing-list mt-20">';
            echo '<div class="row p-lg-3 p-sm-5 p-4">';
            
          
            echo '<div class="col-lg-4 align-self-center">';
            echo '<a href="view/view_annonce.php?id=' . $annonce['id'] . '">';
            echo '<img src="uploads/' . $annonce['image'] . '" class="img-fluid" alt="Image de l\'annonce">';
            echo '</a>';
            echo '</div>';
            
        
            echo '<div class="col-lg-8">';
            echo '<div class="row">';
            
            
            echo '<div class="col-lg-6 col-md-10">';
            echo '<div class="ad-listing-content">';
            echo '<div>';
            echo '<a href="view/view_annonce.php?id=' . $annonce['id'] . '" class="font-weight-bold">' . $annonce['titre'] . '</a>';
            echo '</div>';
            echo '<ul class="list-inline mt-2 mb-3">';
            echo '<li class="list-inline-item"><a href="category.html"><i class="fa fa-folder-open-o"></i> ' . $annonce['categorie_name'] . '</a></li>';
            echo '<li class="list-inline-item"><a href="category.htm"><i class="fa fa-calendar"></i> ' . $annonce['date_creation'] . '</a></li>';
            echo '</ul>';
            echo '<p class="pr-5">' . $annonce['prenom'] . ' ' . $annonce['nom'] . '</p>';
            echo '</div>';
            echo '</div>';
            
            echo '<div class="col-lg-6 align-self-center">';
            echo '<div class=" float-lg-right pb-3">';
           
            echo '<h2 class="font-weight-bold text-primary"> ' . $annonce['prix'] . 'FCFA </h2>'; 
            echo '</div>';
            echo '</div>';
            
            echo '</div>';
            echo '</div>'; 
            
            echo '</div>';
            echo '</div>'; 
        }
        
    } else {
        echo '<p>Aucune annonce disponible pour cette catégorie.</p>';
    }
} else {
    

?>

    <div class="row mt-30">
        <?php while ($annonce = $annonces->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="col-lg-4 col-md-6">
                <!-- product card -->
                <div class="product-item bg-light">
                    <div class="card">
                        <div class="thumb-content">
                            <div class="price"><?= $annonce['prix'] ?> FCFA</div>
                            <a href="view/view_annonce.php?id=<?= $annonce['id'] ?>">
                                <img class="card-img-top img-fluid fixed-size-image"  src="uploads/<?= $annonce['image'] ?>" alt="Card image cap">
                            </a>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><a href="view/view_annonce.php?id=<?= $annonce['id'] ?>"><?= $annonce['titre'] ?></a></h4>
                            <ul class="list-inline product-meta">
                                <li class="list-inline-item">
                                    <a href="#"><i class="fa fa-folder-open-o"></i><?= $annonce['categorie_name'] ?></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><i class="fa fa-calendar"></i><?= $annonce['date_creation'] ?></a>
                                </li>
                            </ul>
                            <p class="card-text"><?= $annonce['prenom'] . ' ' . $annonce['nom'] ?></p>
                            <a href="view/view_annonce.php?id=<?= $annonce['id'] ?>" class="btn btn-primary">Voir Détail</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
	<?php } ?>
</div>

			</div>
		</div>
	</div>
</section>


<?php require 'footer.php'; ?>