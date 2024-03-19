<?php

require_once __DIR__ . '/../vendor/autoload.php';
use App\Page;

$page = new Page();

$interventions = $page->getAllInterventions(); 


echo $page->render('userinterventions.html.twig', ['interventions' => $interventions]);



?>
