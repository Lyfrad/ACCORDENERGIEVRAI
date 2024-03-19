<?php

session_start();

require_once '../vendor/autoload.php';

use App\Page as AppPage;

$page = new AppPage();


//Connexion utilisateur
if (!isset($_SESSION['idUser'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['id'];

    // Suppression de l'utilisateur
    if ($page->deleteUser($userId)) {
        header("Location: admin.php");
        exit;
    } else {
        
    }
}
?>
