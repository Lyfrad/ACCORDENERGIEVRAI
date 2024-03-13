<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$msg = '';

//session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST["mail"];
    $password = $_POST["password"];
    $user = $page->getUserByUsername($username);

    if (!empty($user) /*&& password_verify($password, $user["password"])*/) {
        $msg = "NoOURTRE THect.";

        $_SESSION["mail"] = $username;
        header("Location: main.php");
        exit;
    } else {
        $msg = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

if (!empty($_SESSION["mail"])) { // Check if the user is logged in
    $msg = ''; // Clear the message if the user is logged in
}

$template = 'index.html.twig';
$data = ['msg' => $msg];

echo $page->render($template, $data);
?>
