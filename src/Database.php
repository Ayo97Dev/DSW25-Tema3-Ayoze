<?php

namespace Dsw\Blog;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    // patron singleton para obtener la conexión a la base de datos
    // devuelve una instancia de PDO y la reutiliza si ya existe
    public static function getConnection(): PDO
    {
        if (self::$connection) {
            return self::$connection;
        }

        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        $host = $_ENV['DB_HOST'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];
        $db = $_ENV['DB_NAME'];
        $charset = $_ENV['DB_CHARSET'];


        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            self::$connection = new PDO($dsn, $user, $pass, $options);
            return self::$connection;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
