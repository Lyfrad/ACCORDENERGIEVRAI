<?php
// index.php

// Chargement de l'autoloader de Twig
require_once '../vendor/autoload.php';

use App\Page;
$page = new Page();

// Définition des données à passer au template
$data = [
    'title' => 'Accueil - AccordEnergies',
    'menu' => [
        ['title' => 'Accueil', 'url' => '/'],
        ['title' => 'Services', 'url' => '/services'],
        ['title' => 'Contact', 'url' => '/contact'],
        ['title' => 'Mon compte', 'url' => '/compte'],
        // Ajoutez autant de pages que vous voulez
    ],
    'content' => [
        'title' => 'Bienvenue sur le site d\'AccordEnergies',
        'subtitle' => 'Votre partenaire pour la gestion de vos interventions',
        'text' => 'AccordEnergies est une entreprise spécialisée dans la gestion d\'interventions pour les particuliers et les professionnels. Nous intervenons dans les meilleurs délais pour résoudre tous vos problèmes de dépannage, d\'entretien et de maintenance.',
        'button' => [
            'text' => 'Découvrir nos services',
            'url' => '/services',
        ],
    ],
];

// Chargement du template "index.html.twig" et affichage du rendu
echo $page->render('index.html.twig', $data);