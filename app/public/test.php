<?php

require_once 'vendor/autoload.php';

use App\Page;

$page = new Page();

// Tester la récupération d'un utilisateur par nom d'utilisateur
$username = "John"; // Nom d'utilisateur à rechercher
$user = $page->getUserByFirstname([':prenom' => $username]);
echo "Utilisateur trouvé : <pre>" . print_r($user, true) . "</pre>";

// Insérer un nouvel utilisateur dans la base de données
$new_user_data = [
    'password' => 'motdepasse123',
    'prenom' => 'Jane',
    'nom' => 'Doe', // Assurez-vous que ce champ correspond à un champ existant dans votre table 'user'
    'statut' => 'Actif',
    'adresse' => '123 rue de Test',
    'telephone' => '123-456-7890',
    'mail' => 'jane.doe@example.com',
    'type' => 'Client',
    'id' => 1, // Remplacer par l'ID approprié
];
$page->renderTable('user', $new_user_data);

echo "Nouvel utilisateur inséré avec succès.";

?>