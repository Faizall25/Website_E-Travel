<?php

namespace Config;

use PDO;
use PDOException;

class Connection
{
    private static $dbHost = 'localhost';
    private static $dbName = 'e_travel_fix';
    private static $dbUser = 'root';
    private static $dbPass = '';
    public static $pdo = null;

    public static function start(): PDO
    {
        try {
            if (self::$pdo == null) {
                $pdo = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUser, self::$dbPass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                self::$pdo = $pdo;
                return $pdo;
            } else {
                return self::$pdo;
            }
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function close(PDO $pdo)
    {
        $pdo = null;
    }
}
