<?php

session_start(); // Start the session

require_once '../vendor/autoload.php';
use App\Page;

$page = new Page();
$utilisateur = $page -> getUserByUsername($_SESSION["mail"]);
$idUser=$utilisateur["idUser"];
$interventions = $page->getUserInterventions($idUser); 

echo $page->render('userinterventions.html.twig', ['interventions' => $interventions]);


?>
