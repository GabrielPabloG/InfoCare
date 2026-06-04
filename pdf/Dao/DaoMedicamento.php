<html>
	<head>
		<meta charset="UTF-8">
		<title>Bem-Vindo</title>
	</head>
	<body style="background-color: #728CA6;">
	
	</body>
</html>

<?php
    require_once '../Model/Medicamento.php';
    include_once 'conexao.php';

    class DaoMedicamento{
        //rotina de cadastro do usuário no banco de dados
        public function cadastrarMedicamento($medicamento){
            $conexao = abrirconexao();
            
            $queryInsert = "insert into tbMedicacao(nomeMedicacao, dosagemMedicacao, horarioMedicacao, composicaoMedicamento)
            values ('".$medicamento->getNomeMedicamento()."', '".$medicamento->getDosagemMedicamento()."', '".$medicamento->getHorarioMedicamento()."', '".$medicamento->getPosologia()."', '".$medicamento->getComposicaoMedicamento()."')";
            
            echo($queryInsert);
            
            $resultadoInsert = $conexao->query($queryInsert);
            //retorna a quantidade de inserções no banco
            
            $codMedicamento = "SELECT MAX(codMedicacao) codMedicacao FROM tbMedicacao";
                
                $resultado = $conexao->query($codMedicamento);

        while($linharesultado = mysqli_fetch_array($resultado)){
            $codigoMed = $linharesultado['codMedicacao'];
        }
            $codProntuarioFixo = "SELECT MAX(codProntuarioFixo) codProntuarioFixo FROM tbProntuarioFixo";
                
                $resultado1 = $conexao->query($codProntuarioFixo);

        while($linharesultado = mysqli_fetch_array($resultado1)){
            $codigoPront = $linharesultado['codProntuarioFixo'];
        }
            
            $queryInsert1 = "insert into tbMedicacaoProntuario(codProntuarioFixo, codMedicacao)
            values(".$codigoPront.", ".$codigoMed.")";
            $resultadoReceita = $conexao->query($queryInsert1);
            
            if($resultadoReceita > 0 ){
                echo("<br> Cadastro realizado com sucesso.");
				 header("Location: ../View/homeGerente.php");   
				$conexao->close();
            }else 
                echo($queryInsert1);
                echo("<br> Cadastro não concluiu com sucesso, tente novamente.");
			
			}
			
        }
		
?>