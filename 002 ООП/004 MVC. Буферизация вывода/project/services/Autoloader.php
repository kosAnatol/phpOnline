<?php
namespace App\services;

class Autoloader
{
    public function init(string $className): void
    {
        $fileName = str_replace(
                ['App', "\\"],
                [dirname(__DIR__), DIRECTORY_SEPARATOR],
                $className
            ) . '.php';
        if (file_exists($fileName)) {
            require_once $fileName;
        }
    }
}