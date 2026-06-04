<html>
	<head>
		<meta charset="UTF-8">
		<title>Bem-Vindo</title>
	</head>
	<body style="background-color: #728CA6;">
	
	</body>
</html>

<?php
    require_once 'Pessoa.php';
    include_once 'conexao.php';

    class DaoPessoa{
        //rotina de cadastro do usuário no banco de dados
        public function cadastrarPessoa($pessoa){
            $conexao = abrirconexao();
            
            /*if($funcionario->getCargo == "Gerente") {
                
            }*/
        

                $queryInsert2 = "insert into tbFuncionario(nomePessoa, cpfGerente,  sexoGerente , nascGerente, salarioGerente, emailGerente, senhaGerente)
            values ('".$gerente->getNomeGerente()."', '".$gerente->getCpfGerente()."', '".$gerente->getSexoGerente()."', '".$gerente->getNascGerente()."', '".$gerente->getSalarioGerente()."', '".$gerente->getEmailGerente()."', '"$gerente->getSenhaGerente()"')";

            
            $queryInsert1 = "";
            
            
            echo($queryInsert2);
            
            $resultadoInsert = $conexao->query($queryInsert2);
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