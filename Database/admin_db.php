<?php
require('db_connection.php');
function getAllAnnonces() {
    global $connexion;

    $query = "SELECT annonces.id,annonces.prix, annonces.image, annonces.titre, annonces.description,annonces.categorie_id,
    annonces.date_creation,annonces.date_update, annonces.etat,  annonces.validate, utilisateurs.nom, utilisateurs.prenom, categories.designation as categorie_name
    FROM annonces
    INNER JOIN annonces_utilisateurs ON annonces.id = annonces_utilisateurs.annonce_id
    INNER JOIN utilisateurs ON annonces_utilisateurs.user_id = utilisateurs.id
    INNER JOIN categories ON annonces.categorie_id = categories.id
    ORDER BY annonces.date_creation DESC";
    $stmt = $connexion->prepare($query);
    $stmt->execute();

    return $stmt;
  
}

function validate($annonce_id) {
    global $connexion;

    $query = "UPDATE annonces SET validate = TRUE, etat = 'PUBLIEE' WHERE id = :annonce_id";
    $statement = $connexion->prepare($query);
    $statement->bindParam(':annonce_id', $annonce_id, PDO::PARAM_INT);
    $statement->execute();

}

function rejetAnnonce($annonce_id) {
    global $connexion;
    
    $query = "UPDATE annonces SET  etat = 'REJETEE' WHERE id = :annonce_id";
    $statement = $connexion->prepare($query);
    $statement->bindParam(':annonce_id', $annonce_id, PDO::PARAM_INT);
    $statement->execute();

}



function getOneUser2($id) {
    global $connexion;
    $sql = "DELETE FROM annonces_utilisateurs WHERE user_id = ?";
    $res = $connexion->prepare($sql);
    $res->execute(array($id));

    $query = "SELECT * FROM utilisateurs WHERE id = :id";
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(":id",$id);
    $stmt->execute();
    return $stmt;
}

function deleteUser($id, $userID) {
    global $connexion;

    
    $sql = "DELETE FROM annonces_utilisateurs WHERE user_id  = ?";
    $res = $connexion->prepare($sql);
    $res->execute(array($id));

    $query = "DELETE annonces FROM annonces
            JOIN annonces_utilisateurs ON annonces.id = annonces_utilisateurs.annonce_id
            WHERE annonces_utilisateurs.user_id = ?";
    $stmtDEl = $connexion->prepare($query);
    $stmtDEl->execute(array($id));

    $query = "DELETE FROM utilisateurs WHERE id = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($id));
    $stmt->closeCursor();
}

function getAnnonce($id) {
    global $connexion;

    $query = "SELECT * FROM annonces WHERE id = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($id));
    return $stmt;
}

function updateAnnoncebyadmin($id, $image, $titre,$description, $categorie_id) {
    global $connexion;

    $query = "UPDATE annonces SET image = ?, titre = ?, description = ?, categorie_id = ? WHERE id = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($image, $titre, $description, $categorie_id, $id));

    $stmt->closeCursor();
}

function bloquerUser($user_id) {
    global $connexion;

    $query = "UPDATE utilisateurs SET status = 'Bloquer' WHERE id = ?";
    $statement = $connexion->prepare($query);
    $statement->execute(array($user_id));

}

function debloquerUser($user_id) {
    global $connexion;

    $query = "UPDATE utilisateurs SET status = 'Activer' WHERE id = ?";
    $statement = $connexion->prepare($query);
    $statement->execute(array($user_id));

}