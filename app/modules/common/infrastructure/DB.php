<?php

namespace app\modules\common\infrastructure;

use app\modules\common\IDB;
use PDO;
use PDOStatement;

class DB implements IDB
{
    private static ?PDO $pdo = null;
    private ?PDOStatement $stmt;

    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        if (!self::$pdo) {
            $dsn = 'mysql:host=' . DB_HOST . ':' . DB_PORT . ';dbname=' . DB_DATABASE . ';charset=utf8mb4';
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            self::$pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
        }
    }

    public function prepare(string $query)
    {
        $this->stmt = self::$pdo->prepare($query);
    }

    public function execute(?array $args = null)
    {
        $this->stmt->execute($args);
    }

    public function result(): array
    {
        return $this->stmt->fetch() ?: [];
    }

    /**
     * @return array[]
     */
    public function results(): array
    {
        return $this->stmt->fetchAll() ?: [];
    }
}