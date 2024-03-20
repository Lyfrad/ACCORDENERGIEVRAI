<?php
require_once '../vendor/autoload.php';

use App\Page;
$page = new Page();

$data = [
    'title' => 'Accueil - AccordEnergies',
];

echo $page->render('index.html.twig', $data);
