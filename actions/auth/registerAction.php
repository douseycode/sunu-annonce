<?php

require_once('../../Database/utilisateur_db.php');
if (isset($_POST['envoyer'])) {
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email'])
        && !empty($_POST['password']) && !empty($_POST['confirmpassword'])) {

        $nom = strtoupper($_POST['nom']);
        $prenom = ucfirst(strtolower($_POST['prenom']));
        $email = $_POST['email'];
        $tel=$_POST['tel'];
        $datNai=$_POST['dateNai'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $verifEmail = "SELECT * FROM utilisateurs WHERE email = '$email'";
            $res = $connexion->query($verifEmail);

            if ($res->rowCount() > 0) {
                $erreurEmail = "Cet email existe déjà";
            } elseif ($password != $confirmpassword) {
                $erreurPass = 'Les mots de passe ne correspondent pas';
            } else {
                if(strlen($tel) === 9 && (strpos($tel, '77') === 0 || strpos($tel, '76') === 0)){
                    $photo = $_FILES['img']['name'];
                    $upload = "../../assets/" . $photo;
                    $extensions= array('png','jpg', 'jpeg');
                    $inf=new SplFileInfo($photo);
                    $ex=$inf->getExtension();
                    $hashage = password_hash($password, PASSWORD_DEFAULT);
                    if(in_array($ex, $extensions)){
                        move_uploaded_file($_FILES['img']['tmp_name'], $upload);
                    
                        registerUser($photo, $nom, $prenom, $email, $hashage, $tel, $dateNai);
        
                        $message = "Votre compte a été crée avec succès!";
                        header("Location: login.php?message=" . $message);
                    }else{
                        $errorMessage = "saisir une image valide";
                    }
                }else {
                    $errorMessage = "Le numéro de téléphone doit commencer par 77 ou 76 et avoir exactement 9 chiffres!";
                }
            }
        }
    }
}

