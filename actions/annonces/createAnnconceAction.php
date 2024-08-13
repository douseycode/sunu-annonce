<?php
// session_start();
include '../../../Database/annonce_db.php';

if (isset($_POST['envoyer'])) {
    
    $photo = $_FILES['img']['name'];
    $upload = "../../../uploads/" . $photo;
    move_uploaded_file($_FILES['img']['tmp_name'], $upload);
    $phone = $_SESSION['tel'];
    $prix = $_POST['prix'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $categorie_id = $_POST['categorie_id'];

    $annonce_id=addAnnonce($prix,$photo, $titre, $description, $categorie_id);
    if ($annonce_id) {
       
        $user_id = $_SESSION['id']; 
        addAnnonceUtilisateur($annonce_id, $user_id);
        header("location: my_annonce.php");
        exit;
    }
}