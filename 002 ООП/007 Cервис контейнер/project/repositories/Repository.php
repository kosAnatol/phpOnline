<?php

namespace App\repositories;

use App\engine\Kernel;
use App\entities\Entity;
use App\services\DB;

abstract class Repository
{
    protected ?Entity $entityBase;

    abstract public function getEntityClass(): string;

    protected function getEntityBase(): Entity
    {
        if (empty($this->entityBase)) {
            $entity = $this->getEntityClass();
            $this->entityBase = new $entity();
        }

        return $this->entityBase;
    }

    public function getOne(int $id): object
    {
        $tableName = $this->getEntityBase()->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->getDb()->getOneObject($sql, static::class, [':id' => $id]);
    }

    public function getAll(): array
    {
        $tableName = $this->getEntityBase()->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->getDb()->getAllObjects($sql, static::class);
    }

    public function save(Entity $entity)
    {
        $tableName = $entity->getTableName();
        $sql = "Insert intro {$tableName} ";
        return $this->getDb()->getAllObjects($sql, static::class);
    }

    protected function getDb(): DB
    {
        return Kernel::call()->getContainer()->db;
    }
}