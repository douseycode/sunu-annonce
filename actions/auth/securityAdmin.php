<?php

if(!isset($_SESSION['auth'])){
    header("location: /view/auth/login.php");
    exit;
}

if($_SESSION['profil'] != 1){
    echo "Vous n'avez pas l'autorisation d'accéder à cette page.";
    
    exit();

}