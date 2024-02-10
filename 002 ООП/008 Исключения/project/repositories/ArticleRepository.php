<?php

namespace App\repositories;

use App\entities\ArticleEntity;

/**
 * @method ArticleEntity getEntityBase()
 */
class ArticleRepository extends Repository
{
    public function getEntityClass(): string
    {
        return ArticleEntity::class;
    }

    public function getOne(int $id): object
    {
        $tableName = $this->getEntityBase()->getTableName();
        $sql = "SELECT 'login', 'password' FROM {$tableName} WHERE id = :id";
        return $this->getDb()->getOneObject($sql, static::class, [':id' => $id]);
    }
}