<?php

session_start(); // Start the session

require_once '../vendor/autoload.php';
use App\Page;

$page = new Page();

$interventions = $page->getUserInterventions(); 

echo $page->render('userinterventions.html.twig', ['interventions' => $interventions]);


?>
