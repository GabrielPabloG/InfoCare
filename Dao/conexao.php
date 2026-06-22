<?php

class Conexao {
    private static $instancia;

    public static function getConexao() {
        if (!isset(self::$instancia)) {
            // Railway fornece variáveis MYSQLHOST, MYSQLUSER, etc.
            $host   = getenv('MYSQLHOST')      ?: 'localhost';
            $port   = getenv('MYSQLPORT')      ?: '3306';
            $dbname = getenv('MYSQLDATABASE')  ?: 'bdinfocare_refatorado';
            $user   = getenv('MYSQLUSER')      ?: 'root';
            $pass   = getenv('MYSQLPASSWORD')  ?: '';

            try {
                $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
                self::$instancia = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                die("Erro de conexão com o banco de dados: " . $e->getMessage());
            }
        }
        return self::$instancia;
    }
}