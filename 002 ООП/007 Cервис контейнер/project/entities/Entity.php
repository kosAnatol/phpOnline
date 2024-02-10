<?php

namespace App\entities;

abstract class Entity
{
    abstract public function getTableName(): string;
}