<?php
include_once 'conexao.php';
include_once 'DaoPessoa.php';

class ControleAcessoIC {

    public function logar($email, $senha) {
        
         $conexao = abrirConexao();
        
 
    
     $consulta1 = "SELECT codFuncionario, nomeFuncionario, emailFuncionario, senhaFuncionario, codEnderecoFuncionario FROM tbfuncionario".
         " WHERE emailFuncionario = '$email' AND senhaFuncionario = '$senha'";
    
    $resultado1 = $conexao->query($consulta1);
    
  
  $numresultado1 = mysqli_num_rows($resultado1);

    while($linharesultado1 = mysqli_fetch_array($resultado1)){
        $nome = $linharesultado1['nomeFuncionario'];
        $codigo = $linharesultado1['codFuncionario'];
        $codigoEndereco = $linharesultado1['codEnderecoFuncionario'];
    }

    $consulta2 = "SELECT codGerente, nomeGerente, emailGerente, senhaGerente, codEnderecoGerente FROM tbgerente".
     " WHERE emailGerente = '$email' AND senhaGerente = '$senha'";
    
    $resultado2 = $conexao->query($consulta2);
    
  
  $numresultado2 = mysqli_num_rows($resultado2);

    while($linharesultado2 = mysqli_fetch_array($resultado2)){
        $nome = $linharesultado2['nomeGerente'];
        $codigo = $linharesultado2['codGerente'];
        $codigoEndereco = $linharesultado2['codEnderecoGerente'];
    }

    $consulta3 = "SELECT codResponsavel, nomeResponsavel, emailResponsavel, senhaResponsavel, codEnderecoResponsavel, cpfResponsavel FROM tbresponsavel".
         " WHERE emailResponsavel = '$email' AND senhaResponsavel = '$senha'";
    
    $resultado3 = $conexao->query($consulta3);
    
  
  $numresultado3 = mysqli_num_rows($resultado3);

    while($linharesultado3 = mysqli_fetch_array($resultado3)){
        $nome = $linharesultado3['nomeResponsavel'];
        $codigo = $linharesultado3['codResponsavel'];
        $codigoEndereco = $linharesultado3['codEnderecoResponsavel'];
        $cpf = $linharesultado3['cpfResponsavel'];;
    }
        
    $consulta4 = "SELECT codAdm, emailAdm, senhaAdm FROM tbAdm".
         " WHERE emailAdm = '$email' AND senhaAdm = '$senha'";
    
    $resultado4 = $conexao->query($consulta4);
    
  
  $numresultado4 = mysqli_num_rows($resultado4);

    while($linharesultado4 = mysqli_fetch_array($resultado4)){
        $codigo = $linharesultado4['codAdm'];
    }

  $conexao->close();
        if($numresultado4 == 1){
	 header("Location: ../View/homeAdm.php");
    
    session_start();
    $_SESSION['emailSessao'] = $email;
    $_SESSION['senhaSessao'] = $senha;
    $_SESSION['codUsuario'] = $codigo;

    $_SESSION['cadastrou'] = '';
      
    $_SESSION['cadastrando'] = '';
}
  else if($numresultado3 == 1){
	 header("Location: ../View/homeResponsavel.php");
    
    session_start();
    $_SESSION['emailSessao'] = $email;
    $_SESSION['senhaSessao'] = $senha;
    $_SESSION['nomeSessao'] = $nome;
    $_SESSION['codUsuario'] = $codigo;
    $_SESSION['codEnderecoUsuario'] = $codigoEndereco;
    $_SESSION['cpfUsuario'] = $cpf;
      
    $_SESSION['cadastrou'] = '';
      
    $_SESSION['cadastrando'] = '';
} else if($numresultado2 == 1){
      header("Location: ../View/homeGerente.php");
    
    session_start();
    $_SESSION['emailSessao'] = $email;
    $_SESSION['senhaSessao'] = $senha;
    $_SESSION['nomeSessao'] = $nome;
    $_SESSION['codUsuario'] = $codigo;
    $_SESSION['codEnderecoUsuario'] = $codigoEndereco;
      
    $_SESSION['cadastrou'] = '';
      
    $_SESSION['cadastrando'] = '';
  } else if($numresultado1 == 1){
      header("Location: ../View/homeFuncionario.php");
    
    session_start();
    $_SESSION['emailSessao'] = $email;
    $_SESSION['senhaSessao'] = $senha;
    $_SESSION['nomeSessao'] = $nome;
    $_SESSION['codUsuario'] = $codigo;
    $_SESSION['codEnderecoUsuario'] = $codigoEndereco;
      
    $_SESSION['cadastrou'] = '';
      
    $_SESSION['cadastrando'] = '';
  }
    
else {
      header("Location: ../index.php");
    echo($consulta2);
}
}
        
    }


?>