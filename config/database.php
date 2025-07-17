<?php
/**
 * Clase Database maneja la conexión a la base de datos.
 * Utiliza PDO para conectarse a una base de datos MySQL.
 */
class Database {
    private static $host = 'localhost';
    private static $db = 'prestamo_herramientas1';
    private static $user = 'root';
    private static $pass = '';

    /**
     * Conecta a la base de datos y devuelve una instancia de PDO.
     * @return PDO Instancia de PDO conectada a la base de datos.
     */
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
