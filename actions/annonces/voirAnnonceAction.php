<?php
// require('../../Database/annonce_db.php');



if (isset($_GET['id']) && !empty($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $resultat = getViewAnnonce($_GET['id']);

    if ($resultat->rowCount() > 0) {
        $annonce = $resultat->fetch();
        $prenom=$annonce['prenom'];
        $image = $annonce['image'];
        $titre = $annonce['titre'];
        $prix = $annonce['prix'];
        $categorie=$annonce['categorie_name'];
        $photo=$annonce['photo'];
        $description = $annonce['description'];
        $date=$annonce['date_creation'];
        $nom = $annonce['prenom'] . ' ' . $annonce['nom'];

        
        $categorie_id = $annonce['categorie_id'];
    } else {
        $errorMessage =  'Ce annonce n\'existe pas!';
        header("Location: my_annonce.php?message=" . $errorMessage);
        exit();
    }
} else {
    $errorMessage = "L'id du annonce doit être un entier valide supérieur ou égale à 1 !";
    
}