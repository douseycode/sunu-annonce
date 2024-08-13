<?php
require('db_connection.php');

function getAllCategorie(){
    global $connexion;
    $query = "SELECT * FROM categories";
    $resultat = $connexion->query($query);
    return $resultat;
}
function getAnnoncesByCategorie($categorieId) {
    global $connexion;

    
    $query = "SELECT annonces.id,annonces.prix, annonces.image, annonces.titre, annonces.description,annonces.categorie_id,
    annonces.date_creation,  annonces.validate, utilisateurs.nom,utilisateurs.status, utilisateurs.prenom, categories.designation as categorie_name
    FROM annonces
    INNER JOIN annonces_utilisateurs ON annonces.id = annonces_utilisateurs.annonce_id
    INNER JOIN utilisateurs ON annonces_utilisateurs.user_id = utilisateurs.id
    INNER JOIN categories ON annonces.categorie_id = categories.id  WHERE annonces.validate = 1 AND utilisateurs.status !='Bloquer' and categorie_id =?";
    $stm = $connexion->prepare($query);
    $stm->execute(array($categorieId));

    $res = $stm->fetchAll(PDO::FETCH_ASSOC);

    

    return $res;
}
