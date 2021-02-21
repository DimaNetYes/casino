<?php
define ('S', DIRECTORY_SEPARATOR);
define ('D', dirname(__FILE__).S);

spl_autoload_register(function (string $className)
{
    $className = substr($className, strpos($className, '\\') + 1); //обрезаю testtask
    require_once __DIR__ . '/../src/' . str_replace('\\', '/', $className) . '.php'; //подключаю классы
});

$route = $_GET['route'] ?? ''; //.htaccess RewriteRule ^(.*)$ ./index.php?route=$1 [QSA,L]
$routes = require __DIR__ . '/../src/routes.php'; //src/routes.php массив роутов

$isRouteFound = false;
foreach ($routes as $pattern => $controllerAndAction) {
    preg_match($pattern, $route, $matches); // Array ( [0] => hello/bob [1] => bob )
    if (!empty($matches)) {
        $isRouteFound = true;
        break;
    }
}

if (!$isRouteFound) { //Если совпадений нету
    echo 'Страница не найдена!';
    return;
}

unset($matches[0]); //0 => 'hello/username' 1 =>'username' dont need 0 elemnt

$controllerName = $controllerAndAction[0]; //[\testtask\Controllers\MainController::class, 'sayHello']
$actionName = $controllerAndAction[1];

$controller = new $controllerName();

$controller->$actionName(...$matches);





