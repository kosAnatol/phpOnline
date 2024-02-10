<?php

use App\models\User;

include dirname(__DIR__) . '/services/Autoloader.php';
include dirname(__DIR__) . '/vendor/autoload.php';
spl_autoload_register([(new \App\services\Autoloader()), 'init']);


$config = include_once dirname(__DIR__) . '/engine/config.php';
\App\engine\Kernel::call()->run($config);

