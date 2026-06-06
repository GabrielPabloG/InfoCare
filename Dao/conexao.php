<?php

class Conexao {
    private static $instancia;

    public static function getConexao() {
        if (!isset(self::$instancia)) {
            $servidor = 'localhost';
            $dbname = 'bdinfocare_refatorado'; // Apontando para o banco novo.
            $usuario = 'root';
            $senha = ''; // Mude caso seu MySQL local tenha senha

            try {
                // Instancia o PDO com os parâmetros de conexão e charset
                self::$instancia = new PDO("mysql:host=$servidor;dbname=$dbname;charset=utf8", $usuario, $senha);
                
                // Configura o PDO para lançar exceções em caso de erro no SQL
                self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instancia->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                
            } catch (PDOException $e) {
                // Para a execução e exibe o erro caso o banco esteja fora do ar
                die("Erro de conexão com o banco de dados: " . $e->getMessage());
            }
        }
        return self::$instancia;
    }
}
?>