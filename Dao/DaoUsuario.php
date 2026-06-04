<html>
	<head>
		<meta charset="UTF-8">
		<title>Bem-Vindo</title>
	</head>
	<body style="background-color: #728CA6;">
	
	</body>
</html>

<?php
    require_once '../Model/Usuario.php';
    include_once 'conexao.php';

    class DaoUsuario{
        //rotina de cadastro do usuário no banco de dados
        public function cadastrarUsuario($usuario){
            $conexao = abrirconexao();
            
            $queryInsert = "insert into tbUsuario(nomeUsuario, emailUsuario, senhaUsuario, codEstado)
            values ('".$usuario->getNome()."', '".$usuario->getEmail()."', '".$usuario->getSenha()."', '".$usuario->getEstado()."')";
            
            echo($queryInsert);
            
            $resultadoInsert = $conexao->query($queryInsert);
            //retorna a quantidade de inserções no banco
            
            if($resultadoInsert > 0 ){
                echo("<br> Cadastro realizado com sucesso.");
				 header("Location: ../View/homeGerente.php"); 
				$conexao->close();
            }else 
                echo("<br> Cadastro não concluiu com sucesso, tente novamente.");
			
			}
			
        }
		
?>