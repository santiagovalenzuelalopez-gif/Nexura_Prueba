<?php
class Database {
    private static $host = "127.0.0.1";
    private static $db   = "prueba_nexura";
    private static $user = "root";
    private static $pass = "";
    private static $charset = "utf8mb4";

    public static function connect() {
        $dsn = "mysql:host=".self::$host.";dbname=".self::$db.";charset=".self::$charset;
        try {
            $pdo = new PDO($dsn, self::$user, self::$pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
            return $pdo;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
