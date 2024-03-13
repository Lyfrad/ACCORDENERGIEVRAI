<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if (isset($_POST['send'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $date = $_POST["datePrevue"];
        $degre = $_POST["degreUrgence"];
        $com=$_POST["idCommentaire"];
        $client=$_POST["idclient"];


        $data = [
            'date_prevue' => $date,
            'degre_urgence' => $$degre,
            'commentaire' => $comm,
            'id_client' => $idclient,
            'idIntervention' => 1,
            'id_standardiste' => 1,
            'idUser' => 1,
             'id_intervention' => 1,
        ];

        try {
            $page->renderTable('intervention', $data);
            // Rediriger vers la page après l'inscription réussie
            header("Location: main.php");
            exit;
        } catch (\Exception $e) {
            echo "Erreur lors de l'insertion de l'utilisateur : " . $e->getMessage();
        }
    }
}

echo $page->render('intervention.html.twig', []);