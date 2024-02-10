<?php
namespace App\models;

use App\services\DB;

abstract class Model
{
    abstract protected static function getTableName(): string;

    public static function getOne(int $id): object
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return static::getDb()->getOneObject($sql, static::class, [':id' => $id]);
    }

    public static function getAll(): array
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return static::getDb()->getAllObjects($sql, static::class);
    }

    public function insert(): void
    {
        var_dump(static::class);
        $params = get_class_vars(static::class);
        var_dump($params);


        $sql = "
        INSERT INTO `{$this->getTableName()}` 
            (`login`, `password`, `bod`, `is_admin`) 
        VALUES 
            ('123123', '123123', '2024-02-06', '0');
        ";
        static::getDb()->execute($sql);
    }

    public function update() {

    }

    protected static function getDb(): DB
    {
        return DB::getInstance();
    }
}
