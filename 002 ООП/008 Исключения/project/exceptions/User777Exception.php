<?php

namespace App\exceptions;

class User777Exception extends \Exception
{
    public function log()
    {
        file_put_contents(
            dirname(__DIR__) . '/errors.log',
            $this->getText(),
            FILE_APPEND
        );
    }

    protected function getText(): string
    {
        return sprintf(
            "ФайЛ: %s" . PHP_EOL .
            "Код: %s" . PHP_EOL  .
            '______________' . PHP_EOL,
            $this->getFile(),
            $this->getCode()
        );
    }
}