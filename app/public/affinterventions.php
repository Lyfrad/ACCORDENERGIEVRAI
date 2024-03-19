<?php

require_once __DIR__ . '/../vendor/autoload.php';
use App\Page;

$page = new Page();

$interventions = $page->getAllInterventions(); 

if(isset($_POST['dateIntervention'])) {
    $selectedDate = $_POST['dateIntervention'];
    // Intervention sélectionnée depuis la base de données en fonction de la date
    $selectedIntervention = $page->getInterventionByDate($selectedDate); 
} else {
    $selectedIntervention = null;
}

// Pour la suppression d'une intervention
if(isset($_POST['deleteIntervention'])) {
    $idIntervention = $_POST['deleteIntervention'];
    $rowCount = $page->deleteIntervention($idIntervention);
    if($rowCount > 0) {
        echo "L'intervention a bien été supprimée.";
    } else {
        echo "Erreur lors de la suppression de l'intervention.";
    }
}

// Pour la modification d'une intervention
if(isset($_POST['updateIntervention'])) {
    $updateData = [
        'idIntervention' => $_POST['idIntervention'],
        'date_prevue' => $_POST['date_prevue'],
        'id_client' => $_POST['id_client'],
        'date_fin' => $_POST['date_fin'],
        'date_debut' => $_POST['date_debut'],
        'statut' => $_POST['statut'],
        'degre_urgence' => $_POST['degre_urgence'],
        'id_standardiste' => $_POST['id_standardiste'],
        'commentaire' => $_POST['commentaire']
    ];
    $rowCount = $page->updateIntervention($updateData);
    if($rowCount > 0) {
        echo "L'intervention a bien été mise à jour.";
    } else {
        echo "Erreur lors de la mise à jour de l'intervention.";
    }
}

echo $page->render('affinterventions.html.twig', ['interventions' => $interventions, 'selectedIntervention' => $selectedIntervention]);



?>
