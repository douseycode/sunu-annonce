<?php

// require './Database/annonce_db.php';
$searchResults = null;

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $word = $_GET['search'];
    $searchResults = searchAnnonceByWord($word);
} elseif (isset($_GET['search'])) {
    $errorMessage = "Veuillez saisir l'annonce à rechercher!";
} else {
    $searchResults = null;
}