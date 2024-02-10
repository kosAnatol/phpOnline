<?php

namespace App\engine;

use App\repositories\UserRepository;
use App\services\DB;
use App\services\Render\RenderService;

/**
 * @property DB $db
 * @property DB $log
 * @property RenderService $renderService
 * @property UserRepository $userRepository
 * @property Requset $request
 */
class Container
{
    protected array $components = [];
    protected array $configComponents = [];

//    public function __construct(array $config, Request $request)
    public function __construct(array $config)
    {
        if (!empty($config['components'])) {
            $this->configComponents = $config['components'];
        }

//        $this->components['request'] = $request;
    }

    public function __get(string $name)
    {
        if (array_key_exists($name, $this->components)) {
            return $this->components[$name];
        }

        if (empty($this->configComponents[$name])) {
           echo "В конфиге компонентов не найден {$name}";
        }

        if (empty($this->configComponents[$name]['class'])) {
           echo "В конфиге компонентов не найден для {$name} не указан класс";
           exit();
        }

        $className = $this->configComponents[$name]['class'];
        if (!empty($this->configComponents[$name]['config'])) {
            $component = new $className($this->configComponents[$name]['config']);
        } else {
            $component = new $className();
        }

        $this->components[$name] = $component;
        return $component;
    }
}