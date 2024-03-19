<?php

session_start();

require_once '../vendor/autoload.php';


use App\Page as AppPage;

$page = new AppPage();


// Connexion utilisateur
if (!isset($_SESSION['idUser'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['id'];
    $newStatut = $_POST['statut'];

    // Mise à jour du statut de l'utilisateur
    if ($page->updateUserStatut($userId, $newStatut)) {
        header("Location: admin.php");
        exit;
    } else {
        
    }
}
?>
