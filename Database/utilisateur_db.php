<?php
require('db_connection.php');
function getAllusers(){
    global $connexion;
    $query = "SELECT utilisateurs.id, utilisateurs.nom, utilisateurs.prenom, utilisateurs.email,utilisateurs.photo,
    utilisateurs.tel,utilisateurs.status,profils.designation as profil_name
    FROM utilisateurs
    INNER JOIN profils ON profils.id = utilisateurs.profil_id";
    $resultat = $connexion->query($query);
    return $resultat;
}

function getUserByEmail($email){
    global $connexion;

    $query = "SELECT * FROM utilisateurs WHERE email = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($email));
    return $stmt;
}

function addUser($photo, $nom, $prenom, $email, $password,$tel, $date, $profil_id) {
    global $connexion;

    $query = "INSERT INTO utilisateurs (photo, nom, prenom, email, password, tel, dateNai, profil_id) VALUES(?,?,?,?,?,?,?,?)";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($photo, $nom, $prenom, $email, $password, $tel, $date, $profil_id));
    $stmt->closeCursor();
}

function registerUser($photo, $nom, $prenom, $email, $password,$tel, $date) {
    global $connexion;

    $query = "INSERT INTO utilisateurs (photo, nom, prenom, email, password, tel, dateNai) VALUES(?,?,?,?,?,?,?)";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($photo, $nom, $prenom, $email, $password, $tel, $date));
    $stmt->closeCursor();
}
function verifEmail($email){
    global $connexion;
    $query = "SELECT * FROM utilisateurs WHERE email = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($email));
    return $stmt->rowCount();
}
function getOneUser($id) {
    global $connexion;

    $query = "SELECT * FROM utilisateurs WHERE id = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($id));
    return $stmt;
}
function updateUser($id, $nom, $prenom, $tel, $dateNai) {
    global $connexion;

    $query = "UPDATE utilisateurs SET nom = ?, prenom = ?, tel = ?, dateNai = ? WHERE id = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($nom, $prenom, $tel, $dateNai, $id));

    $stmt->closeCursor();
}

function updateUser2($id, $nom, $prenom, $email, $photo,$tel, $dateNai, $profil_id) {
    global $connexion;

    $query = "UPDATE utilisateurs SET nom = ?, prenom = ?, email = ?, photo = ?, tel= ?, dateNai = ? , profil_id = ? WHERE id = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($nom, $prenom, $email, $photo,$tel, $dateNai, $profil_id, $id));

    $stmt->closeCursor();
}

function uptdateImage($id,$img){
    global $connexion;
    $query = "UPDATE utilisateurs SET photo = ? WHERE id = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($img, $id));

    $stmt->closeCursor();
}

function updteEmail($id,$email){
    global $connexion;
    $query = "UPDATE utilisateurs SET email = ? WHERE id = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($email, $id));

    $stmt->closeCursor();

}

function uptdatePassword($id,$hash){
    global $connexion;
    
    $query = "UPDATE utilisateurs SET password = ? WHERE id = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($hash, $id));

    $stmt->closeCursor();
}

function verifPassword($id, $password) {
    global $connexion;
    
    $query = "SELECT password FROM utilisateurs WHERE id = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($id));
    $row = $stmt->fetch();
    $hash = $row["password"];
    $res=password_verify($password, $hash);

    return  $res;
}