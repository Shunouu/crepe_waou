<?php

$router = new AltoRouter();
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$router->setBasePath($basePath);

$router->map('GET', '/', 'MainController#home', 'home');
$router->map('POST', '/ajouter_au_panier', 'MainController@ajouterAuPanier', '/ajouter_au_panier');
$router->map('GET', '/panier', 'MainController#panier', 'panier');
$router->map('GET', '/supprimer_panier', 'MainController#supprimer_panier', 'supprimer_panier');
$router->map('GET', '/formulaire', 'MainController#formulaire', 'formulaire');
$router->map('GET', '/login', 'MainController#login', 'login');
$router->map('GET', '/categories', 'MainController#categories', 'categories');
$router->map('GET', '/cd', 'MainController#cd', 'cd');
$router->map('GET', '/dvd', 'MainController#dvd', 'dvd');
$router->map('GET', '/accessoires', 'MainController#accessoires', 'accessoires');

return $router;