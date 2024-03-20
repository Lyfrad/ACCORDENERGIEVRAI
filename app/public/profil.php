<?php

session_start(); 

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$msg = '';


//if(isset($_GET['idUser'])) {
    // Récupération de l'identifiant de l'utilisateur
    $id_utilisateur = $_SESSION['idUser'];
    $lemail = $_SESSION['mail'];

    $utilisateur = $page->      getUserByUsername($lemail);
   
    $template = 'profil.html.twig';

    echo $page->render($template,[
        'utilisateur' => $utilisateur,
    ]);
//} 

?>
