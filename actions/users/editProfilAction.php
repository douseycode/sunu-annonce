<?php
require('../../Database/utilisateur_db.php');



$user_id = $_SESSION['id'];
$sql = "SELECT * FROM utilisateurs WHERE id = '$user_id'";
$result = $connexion->query($sql);
$row = $result->fetch();

if (isset($_POST['modifier'])) {
    if (isset($_POST['nom'], $_POST['prenom'], $_POST['tel'], $_POST['dateNai']) && !empty($_POST['nom']) && !empty($_POST['prenom'])  && $_POST['tel'] && $_POST['dateNai']) {
        extract($_POST);
        updateUser($user_id, $nom, $prenom, $tel, $dateNai); 
        $message = "Votre profil a été modifié avec succès!";
        header("Location: profil.php");
        exit();
        
    } else {
        $errorMessage = 'Les champs sont obligatoires !';
        
    }
}


if (isset($_POST['upload_image'])){
    if (isset($annonce['image']) && !empty($annonce['image'])) {
        $imgA = "../../assets/" . $annonce['image'];
        if (file_exists($imgA)) {
            unlink($imgA);
        }
    }
    $photo = $_FILES['profile_picture']['name'];
    $upload = "../../assets/" . $photo;
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], $upload);
    uptdateImage($user_id, $photo);
    header("Location: profil.php");
    exit();
}

if(isset($_POST['upmail'])){
    if(isset($_POST['email']) && !empty($_POST['email'])){
        extract($_POST);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $res = verifEmail($email);
            if ($res == 0) {
                updteEmail($user_id,$email);
                header("Location: profil.php");
                exit();
            }else {
                $errorMessage = "Cet email existe déjà";
            }
        }
        
    }else {
        $errorMessage = 'Le champ email est obligatoire !';
        
    }
}

if(isset($_POST['editPassword'])){
    if(isset($_POST["password"],$_POST["newpassword"],$_POST["confirmpassword"]) && !empty($_POST['password']) && !empty($_POST["newpassword"]) && !empty($_POST["confirmpassword"])){
        extract($_POST);
        if ($newpassword === $confirmpassword) {
            if(verifPassword($user_id,$password)){
                $hash=password_hash($newpassword, PASSWORD_DEFAULT);
                uptdatePassword($user_id,$hash);
                header("Location: profil.php");
                exit();
            }else {
                $errorPass = "les mots de passe incorrect";
            }
            
        }else {
            $errorPass = "les mots de passe ne sont pas identique";
        }
    }

}