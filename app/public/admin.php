<?php
require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$msg = '';

$interventions = $page->getAllInterventions(); // Récupère toutes les interventions depuis la base de données

echo $page->render('admin.html.twig', ['interventions' => $interventions]);
?>
