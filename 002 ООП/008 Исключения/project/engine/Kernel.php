<?php

namespace App\engine;

use App\traits\SingletonTrait;

class Kernel
{
    use SingletonTrait;

    protected ?Container $container;

    public static function call(): Kernel
    {
        return static::getInstance();
    }


    public function run(array $config)
    {
        $controller = $_GET['c'] ?? 'user';
        $action = $_GET['a'] ?? '';

        $controllerName = 'App\\controllers\\' . ucfirst($controller) . 'Controller';
        if (!class_exists($controllerName)) {
            echo '404';
            exit();
        }

//        $request = (new Request())->init();
//        (new $controllerName(
//            $this->initContainer($config, $request))
//        )
//            ->run($action);

        (new $controllerName($this->initContainer($config)))
            ->run($action);
    }

    protected function initContainer(array $config): Container
    {
        $this->container = new Container($config);

        return $this->container;
    }

    public function getContainer(): Container
    {
        return $this->container;
    }

}