<?php

$router = new AltoRouter();
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$router->setBasePath($basePath);

$router->map('GET', '/', 'MainController#home', 'home');
$router->map('GET', '/panier', 'MainController#panier', 'panier');
$router->map('GET', '/formulaire', 'MainController#formulaire', 'formulaire');
$router->map('POST', '/formulaire', 'MainController#processForm', 'processForm');
$router->map('GET|POST', '/login', 'MainController#login', 'login');
$router->map('GET', '/product', 'MainController#product', 'product');
$router->map('POST', '/product', 'MainController#product', 'product_post');
$router->map('GET', '/logout', 'MainController#logout', 'logout');
$router->map('GET', '/categories', 'MainController#categories', 'categories');
$router->map('GET', '/cd', 'MainController#cd', 'cd');
$router->map('GET', '/dvd', 'MainController#dvd', 'dvd');
$router->map('GET', '/accessoires', 'MainController#accessoires', 'accessoires');


return $router;