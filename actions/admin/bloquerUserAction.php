<?php
require('../../Database/admin_db.php');


if(isset($_GET['id']) AND !empty($_GET['id']) AND filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))){
    session_start();
    if($_GET['id'] == $_SESSION['id']){
        $message= "Impossible de bloquer";
        
        header("Location: /view/admin/users/users.php?message=" . $message);
        exit;
    }
    $resultat = getOneUser2($_GET['id']);

    if($resultat->rowCount() > 0){
        $user = $resultat->fetch();
        bloquerUser($user['id']);
        $message = "Le utilisateur a été bloquer avec succès!";
        header("Location:/view/admin/users/users.php?message=" . $message);
    }else{
        $errorMessage =  'Ce utilisateur n\'existe pas!';
    }
}else{
    $errorMessage = "L'id d' utilisateur doit être un entier valide supérieur ou égale à 1 !";
}