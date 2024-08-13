<?php
require('../../../Database/annonce_db.php');
require('../../../Database/categorie_db.php');
$categories = getAllCategorie();

if (isset($_GET['id']) && !empty($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $resultat = getOneAnnonce($_GET['id']);

    if ($resultat->rowCount() > 0) {
        $annonce = $resultat->fetch();
        $image = $annonce['image'];
        $titre = $annonce['titre'];
        $prix = $annonce['prix'];
        $description = $annonce['description'];
        
        $categorie_id = $annonce['categorie_id'];
    } else {
        $errorMessage =  'Ce annonce n\'existe pas!';
        header("Location: my_annonce.php?message=" . $errorMessage);
        exit();
    }
} else {
    $errorMessage = "L'id du annonce doit être un entier valide supérieur ou égale à 1 !";
    header("Location:my_annonce.php?message=" . $errorMessage);
    exit();
}

if (isset($_POST['envoyer'])) {
    if (isset( $_POST['titre'],$_POST['prix'], $_POST['description'], $_POST['categorie_id']) && !empty($_POST['titre'])  && !empty($_POST['description']  &&  $_POST['categorie_id'])) {
        extract($_POST);
        if (!empty($_FILES['img']['name'])) {
            if (isset($annonce['image']) && !empty($annonce['image'])) {
                $ancienne_image = "../../../uploads/" . $annonce['image'];
                if (file_exists($ancienne_image)) {
                    unlink($ancienne_image);
                }
            }
            $image = $_FILES['img']['name'];
        $upload = "../../../uploads/" . $image;
        move_uploaded_file($_FILES['img']['tmp_name'], $upload);
        }else {
            
            $image = $annonce['image'];
        }

        if ($annonce['etat'] === 'REJETEE') {
            
            updateAnnonceRejet($annonce['id'], 'EN_COURS_VALIDATION');
        }
        
        updateAnnonce($annonce['id'], $image, $titre,$prix,$description, $categorie_id);
        $message = "Le annonce a été modifié avec succès!";
        header("Location: my_annonce.php?message=" . $message);
        exit();
    } else {
        $errorMessage = 'Les champs sont obligatoires !';
        header("Location: my_annonce.php?message=" . $errorMessage);
        exit();
    }
}


