<?php
require ('../../Database/utilisateur_db.php');
if(isset($_POST['send'])){
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            $check  = getUserByEmail($email);

            if($check->rowCount() > 0) {
                $userInfos = $check->fetch();
                $statut = $userInfos['status'];
                if($statut == 'Bloquer'){
                    $errorMessage= "Ce compte est bloquer";}
                elseif(password_verify($password, $userInfos['password'])){
                    session_start();
                    $_SESSION['auth'] = true;
                    $_SESSION['id'] = $userInfos['id'];
                    $_SESSION['nom'] = $userInfos['nom'];
                    $_SESSION['prenom'] = $userInfos['prenom'];
                    $_SESSION['email'] = $userInfos['email'];
                    $_SESSION['tel'] = $userInfos['tel'];
                    $_SESSION['profil'] = $userInfos['profil_id'];
                    header('Location: ../../index.php');
                    exit;
                } else $errorMessage = "Mot de passe incorrect !";
            }else $errorMessage = "Email incorrect !";
        }else $errorMessage = "Veuillez saisir un email valide !";
    }else $errorMessage = "Veuillez remplir les champs obligatoires !";
}