<?php
require('db_connection.php');

function getAllProfil(){
    global $connexion;
    $query = "SELECT * FROM profils";
    $resultat = $connexion->query($query);
    return $resultat;
}

function addProfil($designation) {
    global $connexion;

    $query = "INSERT INTO profils(designation) VALUES(:designation)";
    $stmt = $connexion->prepare($query);
    $stmt->execute(['designation' => $designation]);
    $stmt->closeCursor();
}

function getOneProfil($id) {
    global $connexion;

    $query = "SELECT * FROM profils WHERE id = $id";
    $stmt = $connexion->prepare($query);
    $stmt->execute();
    return $stmt;
}

function getOneProfil2($id) {
    global $connexion;

    $query = "SELECT * FROM profils WHERE id = :id";
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(":id",$id);
    $stmt->execute();
    return $stmt;
}

function updateProfil($id, $designation) {
    global $connexion;

    $query = "UPDATE profils SET designation = ? WHERE id = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($designation, $id));
    $stmt->closeCursor();
}

function deleteProfil($id) {
    global $connexion;

    $query = "DELETE FROM profils WHERE id = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute(array($id));
    $stmt->closeCursor();
}