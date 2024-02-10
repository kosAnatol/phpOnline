<?php
namespace App\services;

use App\models\Model;
use App\traits\SingletonTrait;

/**
 * @method static DB getInstance()
 */
class DB
{
    use SingletonTrait;

    protected string $host = '127.0.0.1';
    protected string $db = 'php_online';
    protected string $charset = 'UTF8';
    protected string $user = 'root';
    protected string $password = '';

    protected ?\PDO $connect;

    public function getConnect(): \PDO
    {
        if (empty($this->connect)) {
            $this->connect = new \PDO(
                $this->getDsn(),
                $this->user,
                $this->password
            );

            $this->connect->setAttribute(
                \PDO::ATTR_DEFAULT_FETCH_MODE,
                \PDO::FETCH_ASSOC
            );
        }

        return $this->connect;
    }


    public function getOne(string $sql, array $params = []): array
    {
        return $this->query($sql, $params)
            ->fetch();
    }

    public function getOneObject(string $sql, string $className, array $params = []): object
    {
        $PDOStatement = $this->query($sql, $params);
        $PDOStatement->setFetchMode(\PDO::FETCH_CLASS, $className);
        return $PDOStatement->fetch();
    }

    public function getAll(string $sql, array $params = []): array
    {
        return $this->query($sql, $params)
            ->fetchAll();
    }

    public function getAllObjects(string $sql, string $className, array $params = []): array
    {
        $PDOStatement = $this->query($sql, $params);
        $PDOStatement->setFetchMode(\PDO::FETCH_CLASS, $className);
        return $PDOStatement->fetchAll();
    }

    public function execute(string $sql, array $params = [])
    {
        return $this->query($sql, $params);
    }

    protected function query(string $sql, array $params = []) {
        $PDOStatement = $this->getConnect()->prepare($sql);
        $PDOStatement->execute($params);
        return $PDOStatement;
    }


    protected function getDsn(): string
    {
        return sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            $this->host,
            $this->db,
            $this->charset
        );
    }
}