<?php
class Database {
    private static $connection = null;

    public static function getConnection() {
        if (self::$connection === null) {
            $dotenv = parse_ini_file('.env');
            $host = $dotenv['DB_HOST'];
            $db = $dotenv['DB_NAME'];
            $user = $dotenv['DB_USER'];
            $pass = $dotenv['DB_PASS'];

            try {
                self::$connection = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Database connection failed: ' . $e->getMessage());
            }
        }

        return self::$connection;
    }
}