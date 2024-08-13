<?php
require('../../Database/annonce_db.php');


if(isset($_GET['id']) AND !empty($_GET['id']) AND filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))){
    $resultat = getOneAnnonce2($_GET['id']);

    if($resultat->rowCount() > 0){
        $annonce = $resultat->fetch();
        deleteAnnonce($annonce['id']);
        $imgA = "../../uploads/" . $annonce['image'];
        if (file_exists($imgA)) {
            unlink($imgA);
        }
        $message = "annonce a été supprimée avec succès!";
        header("Location: /view/users/myespace/my_annonce.php");
        exit;
    }else{
        $errorMessage =  'Ce annonce n\'existe pas!';
    }
}else{
    $errorMessage = "L'id d' annonce doit être un entier valide supérieur ou égale à 1 !";
}