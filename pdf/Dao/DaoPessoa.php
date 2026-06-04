<html>

<head>
    <meta charset="UTF-8">
    <title>Bem-Vindo</title>
</head>

<body style="background-color: #728CA6;">

</body>

</html>

<?php
    require_once '../Model/Pessoa.php';
    require_once '../Model/Funcionario.php';
    include_once 'conexao.php';

    class DaoPessoa{
        //rotina de cadastro do usuário no banco de dados
        public function cadastrarPessoa($pessoa, $funcionario){
            $erro = "nenhum";
            $res = false;
            $ge = false;
            $conexao = abrirconexao();
            session_start();
            
            if($funcionario->getCargoFuncionario() == "Funcionario") {
                
                $endereco = "insert into tbEnderecoFuncionario(ruaEnderecoFuncionario, bairroEnderecoFuncionario, cepEnderecoFuncionario, numCasaFuncionario)
                values ('".$pessoa->getRuaEndereco()."', '".$pessoa->getBairroEndereco()."', '".$pessoa->getCepEndereco()."', '".$pessoa->getNumCasaEndereco()."')";
                
                $resultadoSelect = $conexao->query($endereco);
                
                $codEndereco = "SELECT MAX(codEnderecoFuncionario) codEnderecoFuncionario FROM tbEnderecoFuncionario";
                
                $resultado = $conexao->query($codEndereco);

        while($linharesultado = mysqli_fetch_array($resultado)){
            $codigo = $linharesultado['codEnderecoFuncionario'];
        }
                
                $consulta1 = "SELECT codFuncionario, nomeFuncionario, emailFuncionario, senhaFuncionario FROM tbFuncionario".
         " WHERE emailFuncionario = '".$pessoa->getEmailPessoa()."'";
    $consulta2 = "SELECT codGerente, nomeGerente, emailGerente, senhaGerente FROM tbGerente".
         " WHERE emailGerente = '".$pessoa->getEmailPessoa()."'";
    $consulta3 = "SELECT codResponsavel, nomeResponsavel, emailResponsavel, senhaResponsavel FROM tbResponsavel".
         " WHERE emailResponsavel = '".$pessoa->getEmailPessoa()."'";
    
    $resultado1 = $conexao->query($consulta1);
    $resultado2 = $conexao->query($consulta2);
    $resultado3 = $conexao->query($consulta3);
  
    $numresultado1 = mysqli_num_rows($resultado1);
    $numresultado2 = mysqli_num_rows($resultado2);
    $numresultado3 = mysqli_num_rows($resultado3);
  
    if($numresultado1 == 0 && $numresultado2 == 0 && $numresultado3 == 0 || $numresultado2 == 0 && $numresultado1 == 0 && $numresultado3 ==0 || $numresultado3 == 0 && $numresultado1 == 0 && $numresultado2 == 0){
        
        $queryInsert1 = "insert into tbFuncionario(nomeFuncionario, cpfFuncionario,  sexoFuncionario , nascFuncionario, salarioFuncionario, emailFuncionario, senhaFuncionario, codEnderecoFuncionario)
            values ('".$pessoa->getNomePessoa()."', '".$pessoa->getCpfPessoa()."', '".$pessoa->getSexoPessoa()."', '".$pessoa->getNascPessoa()."', '".$funcionario->getSalarioFuncionario()."', '".$pessoa->getEmailPessoa()."', '".$pessoa->getSenhaPessoa()."', ".$codigo.")";

                $resultadoInsert = $conexao->query($queryInsert1);
                $funfou = true;
        
        $cod = "SELECT MAX(codFuncionario) codFuncionario FROM tbFuncionario";
                
                $resultado = $conexao->query($cod);

        while($linharesultado = mysqli_fetch_array($resultado)){
            $cod = $linharesultado['codFuncionario'];
        }
                
            foreach($pessoa->getTelefonePessoa() as $i => $telefones) {
                    $telefone = "insert into tbTelefoneFuncionario(numeroTelefoneFuncionario, codFuncionario)
                    values ('".$telefones[$i]."', ".$cod.")";
                    $resultadoInsert1 = $conexao->query($telefone);
                    $i++;
                }
        }
        else {
            $funfou = false;
            $erro = "cadastroFuncionario";
        }
                
            }
            else if($funcionario->getCargoFuncionario() == "Gerente") {
                
                $endereco = "insert into tbEnderecoGerente(ruaEnderecoGerente, bairroEnderecoGerente, cepEnderecoGerente, numCasaEnderecoGerente)
                values ('".$pessoa->getRuaEndereco()."', '".$pessoa->getBairroEndereco()."', '".$pessoa->getCepEndereco()."', '".$pessoa->getNumCasaEndereco()."')";
                
                $resultadoInsert = $conexao->query($endereco);
                
                $codEndereco = "SELECT MAX(codEnderecoGerente) codEnderecoGerente FROM tbEnderecoGerente";
                
                 $resultado = $conexao->query($codEndereco);

        while($linharesultado = mysqli_fetch_array($resultado)){
            $codigo = $linharesultado['codEnderecoGerente'];
        }
                
                $consulta1 = "SELECT codFuncionario, nomeFuncionario, emailFuncionario, senhaFuncionario FROM tbFuncionario".
         " WHERE emailFuncionario = '".$pessoa->getEmailPessoa()."'";
    $consulta2 = "SELECT codGerente, nomeGerente, emailGerente, senhaGerente FROM tbGerente".
         " WHERE emailGerente = '".$pessoa->getEmailPessoa()."'";
    $consulta3 = "SELECT codResponsavel, nomeResponsavel, emailResponsavel, senhaResponsavel FROM tbResponsavel".
         " WHERE emailResponsavel = '".$pessoa->getEmailPessoa()."'";
    
    $resultado1 = $conexao->query($consulta1);
    $resultado2 = $conexao->query($consulta2);
    $resultado3 = $conexao->query($consulta3);
  
    $numresultado1 = mysqli_num_rows($resultado1);
    $numresultado2 = mysqli_num_rows($resultado2);
    $numresultado3 = mysqli_num_rows($resultado3);
  
    if($numresultado1 == 0 && $numresultado2 == 0 && $numresultado3 == 0 || $numresultado2 == 0 && $numresultado1 == 0 && $numresultado3 ==0 || $numresultado3 == 0 && $numresultado1 == 0 && $numresultado2 == 0){
        
        $queryInsert1 = "insert into tbGerente(nomeGerente, cpfGerente, sexoGerente, nascGerente, salarioGerente, emailGerente, senhaGerente, codEnderecoGerente)
                values ('".$pessoa->getNomePessoa()."', '".$pessoa->getCpfPessoa()."', '".$pessoa->getSexoPessoa()."', '".$pessoa->getNascPessoa()."', '".$funcionario->getSalarioFuncionario()."', '".$pessoa->getEmailPessoa()."', '".$pessoa->getSenhaPessoa()."', ".$codigo.")";
            

                $resultadoInsert = $conexao->query($queryInsert1);
                $funfou = true;
                $ge = true;
        
        $cod = "SELECT MAX(codGerente) codGerente FROM tbGerente";
                
                $resultado = $conexao->query($cod);

        while($linharesultado = mysqli_fetch_array($resultado)){
            $cod = $linharesultado['codGerente'];
        }
                
            foreach($pessoa->getTelefonePessoa() as $i => $telefones) {
                    $telefone = "insert into tbTelefoneGerente (numeroTelefoneGerente, codGerente)
                    values ('".$telefones[$i]."', ".$cod.")";
                    $resultadoInsert1 = $conexao->query($telefone);
                    $i++;
                }
        }
        else {
            $funfou = false;
            $erro = "cadastroGerente";
        }
    
            }
            else {
  
                $endereco = "insert into tbEnderecoResponsavel(ruaEnderecoResponsavel, bairroEnderecoResponsavel, cepEnderecoResponsavel, numCasaEnderecoResponsavel)
                values ('".$pessoa->getRuaEndereco()."', '".$pessoa->getBairroEndereco()."', '".$pessoa->getCepEndereco()."', '".$pessoa->getNumCasaEndereco()."')";
                
                $resultadoInsert = $conexao->query($endereco);
                
                $codEndereco = "SELECT MAX(codEnderecoResponsavel) codEnderecoResponsavel FROM tbEnderecoResponsavel";
                
                 $resultado = $conexao->query($codEndereco);

        while($linharesultado = mysqli_fetch_array($resultado)){
            $codigo = $linharesultado['codEnderecoResponsavel'];
        }
                
                $consulta1 = "SELECT codFuncionario, nomeFuncionario, emailFuncionario, senhaFuncionario FROM tbFuncionario".
         " WHERE emailFuncionario = '".$pessoa->getEmailPessoa()."'";
    $consulta2 = "SELECT codGerente, nomeGerente, emailGerente, senhaGerente FROM tbGerente".
         " WHERE emailGerente = '".$pessoa->getEmailPessoa()."'";
    $consulta3 = "SELECT codResponsavel, nomeResponsavel, emailResponsavel, senhaResponsavel FROM tbResponsavel".
         " WHERE emailResponsavel = '".$pessoa->getEmailPessoa()."'";
    
    $resultado1 = $conexao->query($consulta1);
    $resultado2 = $conexao->query($consulta2);
    $resultado3 = $conexao->query($consulta3);
  
    $numresultado1 = mysqli_num_rows($resultado1);
    $numresultado2 = mysqli_num_rows($resultado2);
    $numresultado3 = mysqli_num_rows($resultado3);
  
    if($numresultado1 == 0 && $numresultado2 == 0 && $numresultado3 == 0 || $numresultado2 == 0 && $numresultado1 == 0 && $numresultado3 ==0 || $numresultado3 == 0 && $numresultado1 == 0 && $numresultado2 == 0){
        
        $queryInsert1 = "insert into tbResponsavel(nomeResponsavel, cpfResponsavel, sexoResponsavel, nascResponsavel, emailResponsavel, senhaResponsavel, codEnderecoResponsavel)
                values ('".$pessoa->getNomePessoa()."', '".$pessoa->getCpfPessoa()."', '".$pessoa->getSexoPessoa()."', '".$pessoa->getNascPessoa()."', '".$pessoa->getEmailPessoa()."', '".$pessoa->getSenhaPessoa()."', ".$codigo.")";

                $resultadoInsert = $conexao->query($queryInsert1);
                $funfou = true; 
        
        $cod = "SELECT MAX(codResponsavel) codResponsavel FROM tbResponsavel";
                
                $resultado = $conexao->query($cod);

        while($linharesultado = mysqli_fetch_array($resultado)){
            $cod = $linharesultado['codResponsavel'];
        }
        
        $cpf = "SELECT cpfResponsavel FROM tbResponsavel WHERE codResponsavel = (SELECT MAX(codResponsavel) codResponsavel FROM tbResponsavel)";
        
        $resultado0 = $conexao->query($cpf);

        while($linharesultado = mysqli_fetch_array($resultado0)){
            $cpf = $linharesultado['cpfResponsavel'];
        }
        
        foreach($pessoa->getTelefonePessoa() as $i => $telefones) {
                    $telefone = "insert into tbTelefoneResponsavel (numeroTelefoneResponsavel, codResponsavel)
                    values ('".$telefones[$i]."', ".$cod.")";
                    $resultadoInsert1 = $conexao->query($telefone);
                    $i++;
                }
        $res = true;
        }
        else {
            $funfou = false;
            $erro = "cadastroResponsavel";
        }
        
    }

        while($linharesultado = mysqli_fetch_array($resultado)){
            $codigo = $linharesultado['codEnderecoResponsavel'];
        }
            
            echo($endereco ."<br>". $codEndereco . "<br>");
            echo($queryInsert1);
            echo("<br>".$numresultado3."<br>");
            print_r($telefone);
            
            
            if($resultadoInsert > 0 && $resultadoInsert1 > 0 && $funfou == true && $res == false && $ge == false){
                
                echo("<br> Cadastro realizado com sucesso.");
                $_SESSION['cadastrou'] = 'Cadastro realizado com sucesso.';
				header("Location: ../View/homeGerente.php");    
				$conexao->close();
            }
            else if($resultadoInsert > 0 && $resultadoInsert1 > 0 && $funfou == true && $res == false && $ge == true) {
                echo("<br> Cadastro realizado com sucesso.");
                $_SESSION['cadastrou'] = 'Cadastro realizado com sucesso.';
				header("Location: ../View/homeAdm.php");    
				$conexao->close();
            }
            else if($resultadoInsert > 0 && $resultadoInsert1 > 0 && $funfou == true && $res == true) {
                echo("<br> Cadastro realizado com sucesso.");
                $_SESSION['cadastrou'] = 'Cadastro realizado com sucesso.';
                $_SESSION['codRes'] = $cod;
                $_SESSION['cpfResponsavel'] = $cpf;
                $_SESSION['direto'] = 1;
				header("Location: ../View/cadastroIdosoTab.php");    
				$conexao->close();
            }
            else
            { 
                echo("<br> Cadastro não concluiu com sucesso, tente novamente.");
                $_SESSION['cadastrando'] = 'Cadastro não concluiu com sucesso, E-mail já registrado.';
			 if($erro == "cadastroResponsavel") {
                 header("Location: ../View/cadastroPessoa.php");
             }
             else if($erro == "cadastroGerente"){
                 header("Location: ../View/cadastro.php");
             }
            else if($erro == "cadastroFuncionario"){
                header("Location: ../View/cadastro.php");
            }
            }
                
			}
        
        public function atualizarPessoa($pessoa) {
            $conexao = abrirconexao();
            
            session_start();
            
            if($_SESSION['cargo'] == 'Gerente') {
                    $novosDados1 = "UPDATE tbgerente SET nomeGerente = '".$pessoa->getNomePessoa()."', cpfGerente = '".$pessoa->getCpfPessoa()."', sexoGerente = '".$pessoa->getSexoPessoa()."'
                , nascGerente = '".$pessoa->getNascPessoa()."', emailGerente = '".$pessoa->getEmailPessoa()."', senhaGerente = '".$pessoa->getSenhaPessoa()."' WHERE codGerente = ".$_SESSION['codUsuario'];
            
                $resultado1 = $conexao->query($novosDados1);
            
                $novosDados2 = "UPDATE tbEnderecoGerente SET ruaEnderecoGerente = '".$pessoa->getRuaEndereco()."', bairroEnderecoGerente = '".$pessoa->getBairroEndereco()."', cepEnderecoGerente = '".$pessoa->getCepEndereco()."', numCasaEnderecoGerente = '".$pessoa->getNumCasaEndereco()."' WHERE codEnderecoGerente = ".$_SESSION['codEnderecoUsuario'];
            
                $resultado2 = $conexao->query($novosDados2);
            }
            else if($_SESSION['cargo'] == 'Funcionario') {
                $novosDados1 = "UPDATE tbFuncionario SET nomeFuncionario = '".$pessoa->getNomePessoa()."', cpfFuncionario = '".$pessoa->getCpfPessoa()."', sexoFuncionario = '".$pessoa->getSexoPessoa()."'
                , nascFuncionario = '".$pessoa->getNascPessoa()."', emailFuncionario = '".$pessoa->getEmailPessoa()."', senhaFuncionario = '".$pessoa->getSenhaPessoa()."' WHERE codFuncionario = ".$_SESSION['codUsuario'];
            
                $resultado1 = $conexao->query($novosDados1);
            
                $novosDados2 = "UPDATE tbEnderecoFuncionario SET ruaEnderecoFuncionario = '".$pessoa->getRuaEndereco()."', bairroEnderecoFuncionario = '".$pessoa->getBairroEndereco()."', cepEnderecoFuncionario = '".$pessoa->getCepEndereco()."', numCasaEnderecoFuncionario = '".$pessoa->getNumCasaEndereco()."' WHERE codEnderecoFuncionario = ".$_SESSION['codEnderecoUsuario'];
            
                $resultado2 = $conexao->query($novosDados2);
            }
            else {
                $novosDados1 = "UPDATE tbResponsavel SET nomeResponsavel = '".$pessoa->getNomePessoa()."', cpfResponsavel = '".$pessoa->getCpfPessoa()."', sexoResponsavel = '".$pessoa->getSexoPessoa()."'
                , nascResponsavel = '".$pessoa->getNascPessoa()."', emailResponsavel = '".$pessoa->getEmailPessoa()."', senhaResponsavel = '".$pessoa->getSenhaPessoa()."' WHERE codResponsavel = ".$_SESSION['codUsuario'];
            
                $resultado1 = $conexao->query($novosDados1);
            
                $novosDados2 = "UPDATE tbEnderecoResponsavel SET ruaEnderecoResponsavel = '".$pessoa->getRuaEndereco()."', bairroEnderecoResponsavel = '".$pessoa->getBairroEndereco()."', cepEnderecoResponsavel = '".$pessoa->getCepEndereco()."', numCasaEnderecoResponsavel = '".$pessoa->getNumCasaEndereco()."' WHERE codEnderecoResponsavel = ".$_SESSION['codEnderecoUsuario'];
            
                $resultado2 = $conexao->query($novosDados2);
            }
            
            if($resultado1 > 0 && $resultado2 > 0) {
				echo($novosDados1);
                echo($novosDados2);

                echo("<br> Update realizado com sucesso.");
                $_SESSION['cadastrou'] = 'Update realizado com sucesso.';
				header("Location: ../index.php");    
				$conexao->close();
            }
            else {
                echo($novosDados1);
                echo($novosDados2);
                
                $_SESSION['cadastrou'] = 'Update não realizado com sucesso.';
				header("Location: ../index.php");    
				$conexao->close();
            }
        }
			
        }
		
?>
