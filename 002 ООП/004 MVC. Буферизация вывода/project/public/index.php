<?php
include dirname(__DIR__) . '/services/Autoloader.php';
spl_autoload_register([(new \App\services\Autoloader()), 'init']);

$controller = $_GET['c'] ?? 'user';
$action = $_GET['a'] ?? '';

$controllerName = 'App\\controllers\\' . ucfirst($controller) . 'Controller';
if (!class_exists($controllerName)) {
    echo '404';
    exit();
}

(new $controllerName())->run($action);
