<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if (isset($_POST['send'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $username = $_POST["prenom"];
        $password = $_POST["password"];
        $nom=$_POST["nom"];
        $email=$_POST["mail"];


        // Préparer et exécuter la requête SQL
        $data = [
            'prenom' => $username,
            'password' => $password,
            'nom' => $nom, // Assurez-vous que ce champ correspond à un champ existant dans votre table 'user'
            'statut' => 4,
            'adresse' => '123 rue de Test',
            'telephone' => '123-456-7890',
            'mail' => $email,
            'type' => 'Client',
        ];

        try {
            $page->renderTable('user', $data);
            // Rediriger vers la page main.php après l'inscription réussie
            header("Location: login.php");
            exit;
        } catch (\Exception $e) {
            echo "Erreur lors de l'insertion de l'utilisateur : " . $e->getMessage();
        }
    }
}

echo $page->render('register.html.twig', []);
