<?php
    $mysqli;
    
    function abrirConexao(){
        // Conecta-se ao banco de dados MySQL
        $mysqli = new mysqli('localhost', 'root', '', 'bdinfocare');
            
        //parâmetros para garantir a acentuação
        $mysqli->query("SET NAMES 'utf8'");
        $mysqli->query('SET character_set_connection=utf8');
        $mysqli->query('SET character_set_client=utf8');
        $mysqli->query('SET character_set_results=utf8');

        // Caso algo tenha dado errado, exibe uma mensagem de erro
        if (mysqli_connect_error()) 
            trigger_error(mysqli_connect_error());
        else
            return $mysqli;
    }

    $servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$dbname = "bdinfocare";
       
    $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
    
        $conn->query("SET NAMES 'utf8'");
        $conn->query('SET character_set_connection=utf8');
        $conn->query('SET character_set_client=utf8');
        $conn->query('SET character_set_results=utf8');
    
?>