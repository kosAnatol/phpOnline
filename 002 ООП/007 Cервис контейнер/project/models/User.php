<?php
namespace App\models;

class User extends Model
{
    public int $id = 0;
    public string $login = '';
    public string $password = '';
    public string $bod = '';
    public string $is_admin = '0';
    public string $date_registration = '2024-02-05';

    protected static function getTableName(): string
    {
        return 'users';
    }
}
