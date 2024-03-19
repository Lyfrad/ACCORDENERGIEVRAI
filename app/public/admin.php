<?php

// fichier fonctionnant avec update_user.php et delete_user.php


session_start();

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

// Vérification si l'utilisateur est bien un admin
if (isset($_SESSION['statut']) && $_SESSION['statut'] !== 1) {
    // Si différent, redirection
    header("Location: login.php");
    exit;
}


$users = $page->getAllUsers();

echo $page->render('admin.html.twig', ['users' => $users]);

?>

