<?php
require('db_connection.php');
function getAllAnnonces() {
    global $connexion;

    $query = "SELECT annonces.id, annonces.prix, annonces.image, annonces.titre, annonces.description,annonces.categorie_id,
    annonces.date_creation,  annonces.validate, utilisateurs.nom,utilisateurs.status, utilisateurs.prenom, categories.designation as categorie_name
    FROM annonces
    INNER JOIN annonces_utilisateurs ON annonces.id = annonces_utilisateurs.annonce_id
    INNER JOIN utilisateurs ON annonces_utilisateurs.user_id = utilisateurs.id
    INNER JOIN categories ON annonces.categorie_id = categories.id  WHERE annonces.validate = 1 AND utilisateurs.status !='Bloquer' 
    ORDER BY annonces.date_creation DESC";
    $stmt = $connexion->prepare($query);
    $stmt->execute();

    return $stmt;
  
}
function getViewAnnonce($id) {
    global $connexion;

    $query = "SELECT annonces.id,annonces.prix, annonces.image, annonces.titre, annonces.description, annonces.categorie_id,
              annonces.date_creation, annonces.validate,utilisateurs.photo as photo, utilisateurs.nom, utilisateurs.status, utilisateurs.prenom,
              categories.designation as categorie_name
              FROM annonces
              INNER JOIN annonces_utilisateurs ON annonces.id = annonces_utilisateurs.annonce_id
              INNER JOIN utilisateurs ON annonces_utilisateurs.user_id = utilisateurs.id
              INNER JOIN categories ON annonces.categorie_id = categories.id  
              WHERE annonces.validate = 1 AND annonces.id = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($id));

  

    return $stmt; 
}


function addAnnonce($prix,$photo, $titre, $description, $categorie_id) {
    global $connexion;

    $query = "INSERT INTO annonces (prix,image, titre, description, categorie_id) VALUES (?,?, ?, ?, ?)";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($prix,$photo, $titre, $description, $categorie_id));

    
    $sql = "SELECT id FROM annonces ORDER BY id DESC LIMIT 1";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();

   
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

   
    $stmt->closeCursor();

    
    return $result['id'];
}

function addAnnonceUtilisateur($annonce_id, $user_id) {
    global $connexion;

    $query = "INSERT INTO annonces_utilisateurs (annonce_id, user_id) VALUES (?, ?)";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($annonce_id, $user_id));
    $stmt->closeCursor();
}

function getAnnonceId($user_id) {
    global $connexion;

    $query = "SELECT annonces.id,annonces.prix, annonces.titre, annonces.description, annonces.image, annonces.etat,
     annonces.validate, annonces.date_creation, annonces.date_update, 
     categories.designation as categorie_name 
     FROM annonces 
     INNER JOIN annonces_utilisateurs ON annonces_utilisateurs.annonce_id = annonces.id 
     INNER JOIN categories ON categories.id = annonces.categorie_id 
     WHERE (annonces.etat='PUBLIEE' OR annonces.etat='EN_COURS_VALIDATION') AND annonces_utilisateurs.user_id = ?";
    $res = $connexion->prepare($query);
    $res->execute(array($user_id));

    
    return $res;
}


function searchAnnonceByWord($word) {
    global $connexion;

    $query = "SELECT annonces.id,annonces.prix, annonces.image, annonces.titre, annonces.description, annonces.categorie_id,
    annonces.date_creation, annonces.etat, annonces.validate, utilisateurs.nom, utilisateurs.prenom, categories.designation as categorie_name
    FROM annonces
    INNER JOIN annonces_utilisateurs ON annonces.id = annonces_utilisateurs.annonce_id
    INNER JOIN utilisateurs ON annonces_utilisateurs.user_id = utilisateurs.id
    INNER JOIN categories ON annonces.categorie_id = categories.id 
    WHERE annonces.validate = 1 AND annonces.titre LIKE '%" . $word . "%'
    ORDER BY annonces.date_creation DESC";

    $res = $connexion->prepare($query);
    $res->execute();

    return $res;
}

function getOneAnnonce($id) {
    global $connexion;

    $query = "SELECT * FROM annonces WHERE id = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($id));
    return $stmt;
}

function updateAnnonce($id, $image, $titre, $prix,$description, $categorie_id) {
    global $connexion;

    $query = "UPDATE annonces SET image = ?, titre = ?,prix =?, description = ?, categorie_id = ? WHERE id = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($image, $titre,$prix, $description, $categorie_id, $id));

    $stmt->closeCursor();
}

function getOneAnnonce2($id) {
    global $connexion;

    $query = "SELECT * FROM annonces WHERE id = :id";
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(":id",$id);
    $stmt->execute();
    return $stmt;
}

function deleteAnnonce($id) {
    global $connexion;
    
    $sql = "DELETE FROM annonces_utilisateurs WHERE annonce_id = ?";
    $res = $connexion->prepare($sql);
    $res->execute(array($id));
 

    $query = "DELETE FROM annonces WHERE id = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($id));
    $stmt->closeCursor();
}

function getRejetAnnonceId($user_id) {
    global $connexion;

    $query = "SELECT  annonces.id,annonces.prix, annonces.titre, annonces.description, annonces.image, annonces.etat,
     annonces.validate, annonces.date_creation, annonces.date_update, 
     categories.designation as categorie_name 
     FROM annonces 
     INNER JOIN annonces_utilisateurs ON annonces_utilisateurs.annonce_id = annonces.id 
     INNER JOIN categories ON categories.id = annonces.categorie_id WHERE annonces_utilisateurs.user_id = ? and annonces.etat = 'REJETEE' ";
    $res = $connexion->prepare($query);
    $res->execute(array($user_id));

    
    return $res;
}

function updateAnnonceRejet($id, $etat) {
    global $connexion;

    $query = "UPDATE annonces SET etat = ? WHERE id = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($etat, $id));

    $stmt->closeCursor();
}
