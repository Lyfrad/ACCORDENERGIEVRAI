<?php

session_start(); 

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST["mail"];
    $password = $_POST["password"];
    $user = $page->getUserByUsername($username);
    $mdp = $page->getPasswordByUser($username);

    if (!empty($user)) {
        $msg = "testnumero1.: $mdp ";

        if($password == $mdp ){
        $msg = "test.";

        $_SESSION["mail"] = $username;
        $_SESSION["idUser"] = $user["idUser"];

        // Redirection en fonction du statut de l'utilisateur, 4 pour client, et 1/2/3 pour admin/intervenant/standartiste
        if ($user["statut"] == 4) {
            header("Location: userinterventions.php");
        } else {
            header("Location: affinterventions.php");
        }
        exit;}
    } else {
        $msg = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}



$template = 'login.html.twig';
$data = ['msg' => $msg];

echo $page->render($template, $data);
?>
