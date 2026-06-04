<?php
include_once 'conexao.php';
include_once 'DaoUsuario.php';

 $conexao = abrirConexao();
 
 $email = $_POST['email'];
$senha = $_POST['senha'];

 $consulta = "SELECT codUsuario, nomeUsuario, emailUsuario, senhaUsuario FROM tbUsuario".
         " WHERE emailUsuario = '$email' AND senhaUsuario = '$senha'";


 $resultado = $conexao->query($consulta);
    
  
  $numresultado = mysqli_num_rows($resultado);

    while($linharesultado = mysqli_fetch_array($resultado)){
        $nome = $linharesultado['nomeUsuario'];
        $codigo = $linharesultado['codUsuario'];
    }

  $conexao->close();
  if($numresultado == 1){
	 header("Location: home.php");
    
    session_start();
    $_SESSION['emailSessao'] = $email;
    $_SESSION['senhaSessao'] = $senha;
    $_SESSION['nomeSessao'] = $nome;
    $_SESSION['codUsuario'] = $codigo;
}
else{
      header("Location: indexOps.php");

}