<?php
require_once '../vendor/autoload.php';

use App\Page;
$page = new Page();
session_start();
$lemail = $_SESSION["mail"];
$user = $page->getUserByUsername($lemail);
$data = ['user' => $user];

echo $page->render('index.html.twig', $data);
