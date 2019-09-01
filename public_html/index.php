<?php

function myAutoLoader(string $className)
{
    require_once __DIR__ . '/../src/' . $className . '.php';
}

spl_autoload_register('myAutoLoader');


$route = $_GET['route'];
$routes = require __DIR__ . '/../src/routes.php';

$isRouteFound = false;
foreach ($routes as $pattern => $controllerAction) {
    preg_match($pattern, $route, $matches);
    if(!empty($matches)) {
        $isRouteFound = true;
        break;
    }
}

if (!$isRouteFound) {
    echo 'Страница не найдена';
    return;
}

unset($matches[0]);

$controllerName = $controllerAction[0];
$actionName = $controllerAction[1];

$controller = new $controllerName();
$controller->$actionName(...$matches);