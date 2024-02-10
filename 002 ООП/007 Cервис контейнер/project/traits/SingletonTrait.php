<?php
namespace App\traits;

trait SingletonTrait
{
    protected static $instance;

    protected function __construct() {}
    protected function __clone() {}
    public function __wakeup() {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance() {
        if (empty(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}