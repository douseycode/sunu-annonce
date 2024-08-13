<?php
require '../../Database/admin_db.php';

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $annonce_id = $_GET['id'];

    if ($action === 'validate') {
        validate($annonce_id);
        header("Location: ../../view/admin/annonces/annonces.php");
        exit;
    } elseif ($action === 'rejet') {
        rejetAnnonce($annonce_id);
        header("Location: ../../view/admin/annonces/annonces.php");
        exit;
    }
}




