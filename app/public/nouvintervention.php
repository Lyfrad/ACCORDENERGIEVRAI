<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

session_start();

if (!isset($_SESSION['mail'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $interventionData = [
        'date_prevue' => $_POST['date_prevue'],
        'id_client' => $_POST['id_client'],
        'date_fin' => $_POST['date_fin'],
        'date_debut' => $_POST['date_debut'],
        'statut' => $_POST['statut'],
        'degre_urgence' => $_POST['degre_urgence'],
        'id_standardiste' => $_POST['id_standardiste'],
        'commentaire' => $_POST['commentaire']
     

        
    ];


    $page->addIntervention($interventionData);

    header("Location: affinterventions.php");
    exit;
}

echo $page->render('nouvintervention.html.twig', []);
?>
