
<?php
require_once('C:\laragon\www\kandji\Database\utilisateur_db.php');
require('C:\laragon\www\kandji\Database\profil_db.php');
$profils = getAllProfil();

if (isset($_GET['id']) && !empty($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $resultat = getOneUser($_GET['id']);

    if ($resultat->rowCount() > 0) {
        $user = $resultat->fetch();
        $nom = $user['nom'];
        $prenom = $user['prenom'];
        $email = $user['email'];
        $tel = $user['tel'];
        $dateNai= $user['dateNai'];
        $photo = $user['photo'];
        
        $profil_id = $user['profil_id'];
    } else {
        $errorMessage =  'Ce user n\'existe pas!';
        header("Location: users.php?message=" . $errorMessage);
        exit();
    }
} else {
    $errorMessage = "L'id du user doit être un entier valide supérieur ou égale à 1 !";
    header("Location:users.php?message=" . $errorMessage);
    exit();
}

if (isset($_POST['envoyer'])) {
    if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'],$_POST['tel'],$_POST['dateNai'], $_POST['profil_id']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email'])  &&  !empty($_POST['profil_id'])) {
        extract($_POST);
        $photo = $_FILES['img']['name'];
        $upload = "../../../assets/" . $photo;
        move_uploaded_file($_FILES['img']['tmp_name'], $upload);
        updateUser2($user['id'], $nom, $prenom, $email, $photo,$tel, $dateNai, $profil_id);

        $message = "Le user a été modifié avec succès!";
        header("Location: users.php?message=" . $message);
        exit();
    } else {
        $errorMessage = 'Les champs sont obligatoires !';
        header("Location: users.php?message=" . $errorMessage);
        exit();
    }
}

