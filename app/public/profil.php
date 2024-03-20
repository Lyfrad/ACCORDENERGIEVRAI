<?php

session_start(); 

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$msg = '';


// Vérifier si l'ID de l'utilisateur a été transmis via la méthode GET/
//if(isset($_GET['idUser'])) {
    // Récupération de l'identifiant de l'utilisateur à partir de la requête GET
    $id_utilisateur = $_SESSION['idUser'];
    $lemail = $_SESSION['mail'];

    // Ici, vous devez implémenter votre logique pour charger les données de l'utilisateur à partir de la base de données
    // Supposons que vous avez une fonction loadUserFromDatabase qui charge les données de l'utilisateur en fonction de son ID
    $utilisateur = $page->      getUserByUsername($lemail); // Vous devez implémenter cette fonction

    // Ici, vous devez implémenter votre logique pour charger les interventions de l'utilisateur à partir de la base de données
    // Supposons que vous avez une fonction loadInterventionsFromDatabase qui charge les interventions de l'utilisateur en fonction de son ID

    // Chemin vers le dossier contenant les templates Twig
    // Initialisation de l'environnement Twig

    // Chargement du template Twig
    $template = 'profil.html.twig';

    // Affichage de la page avec les données passées
    echo $page->render($template,[
        'utilisateur' => $utilisateur,
    ]);
//} 

?>
