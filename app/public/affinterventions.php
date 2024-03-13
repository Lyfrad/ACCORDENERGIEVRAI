<?php

require_once __DIR__ . '/../vendor/autoload.php';
use App\Page;

$page = new Page();

$interventions = $page->getAllInterventions(); 
if(isset($_POST['dateIntervention'])) {
    $selectedDate = $_POST['dateIntervention'];
    // Récupère les détails de l'intervention sélectionnée depuis la base de données en fonction de la date
    $selectedIntervention = $page->getInterventionByDate($selectedDate); // Vous devez implémenter cette méthode dans votre classe Page pour récupérer les détails de l'intervention par date
} else {
    $selectedIntervention = null;
}
echo $page->render('affinterventions.html.twig', ['interventions' => $interventions,     'selectedIntervention' => $selectedIntervention
]);

?>
