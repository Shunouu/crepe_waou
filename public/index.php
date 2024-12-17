<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/controllers/MainController.php';

$router = require_once __DIR__ . '/../src/router/routes.php';

$match = $router->match();

if ($match && isset($match['target'])) {
    if (strpos($match['target'], '#') !== false) {
        [$controller, $method] = explode('#', $match['target']);

        if (class_exists($controller) && method_exists($controller, $method)) {
            (new $controller())->$method();
        } else {
            (new MainController())->notFound();
        }
    } else {
        (new MainController())->notFound();
    }
} else {
    (new MainController())->notFound();
}