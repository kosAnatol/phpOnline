<?php

include dirname(__DIR__) . '/vendor/autoload.php';


$config = include_once dirname(__DIR__) . '/engine/config.php';
\App\engine\Kernel::call()->run($config);

