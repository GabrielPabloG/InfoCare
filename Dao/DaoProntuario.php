<html>
	<head>
		<meta charset="UTF-8">
		<title>Bem-Vindo</title>
	</head>
	<body style="background-color: #728CA6;">
	
	</body>
</html>

<?php
    require_once '../Model/Prontuario.php';
    include_once 'conexao.php';

    class DaoProntuario{
        //rotina de cadastro do usuário no banco de dados
        public function cadastrarProntuario($prontuario, $idoso){
            $conexao = abrirconexao();
            
            $queryInsert = "insert into tbProntuarioDiario(descProntuario, dataProntuario, codIdoso)
            values ('".$prontuario->getDescProntuario()."', CURDATE(), ".$idoso->getId().")";
            
            echo($queryInsert);
            
            $resultadoInsert = $conexao->query($queryInsert);
            //retorna a quantidade de inserções no banco
            
            if($resultadoInsert > 0 ){
                echo("<br> Cadastro realizado com sucesso.");
				 header("Location: ../View/homeFuncionario.php");   
				$conexao->close();
            }else 
                echo("<br> Cadastro não concluiu com sucesso, tente novamente.");
			
			}
			
        }
		
?>