<?php
class Database {
    private static $host = 'localhost';
    private static $db = 'prestamo_herramientas1';
    private static $user = 'root';
    private static $pass = '';

    public static function connect() {
        try {
            $pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$db, self::$user, self::$pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
