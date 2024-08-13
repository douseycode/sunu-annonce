<?php
require ('../../../Database/utilisateur_db.php');

if (isset($_POST['envoyer'])) {
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email'])
        && !empty($_POST['password']) && !empty($_POST['profil_id'])&& !empty($_POST['tel'])&& !empty($_POST['dateNai'])) {
        
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $profil_id = $_POST['profil_id'];
            $tel = $_POST['tel'];
            $dateNai = $_POST['dateNai'];
            $res = verifEmail($email);
            
            if ($res == 0) {
                
                $hashage = password_hash($password, PASSWORD_DEFAULT);
                
                $photo = $_FILES['img']['name'];
                $upload = "../../../assets/" . $photo;
                $extensions= array('png','jpg', 'jpeg');
                $inf=new SplFileInfo($photo);
                $ex=$inf->getExtension();
                if(in_array($ex, $extensions)){
                    move_uploaded_file($_FILES['img']['tmp_name'], $upload);
                
                    addUser($photo, $nom, $prenom, $email, $hashage, $tel, $dateNai, $profil_id);
    
                    $message = "L'utilisateur a été ajouté avec succès!";
                    header("Location:users.php?message=" . $message);
                }else{
                    $errorMessage = "saisir une image valide";
                }
               
            } else {
                $errorMessage = "Cet email existe déjà";
            }
        } else {
            $errorMessage = "Veuillez saisir un email valide !";
        }
    } else {
        $errorMessage = "Veuillez remplir les champs obligatoires !";
    }
}

