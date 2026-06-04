<?php
include_once '../Dao/conexao.php';
$id = $_POST['idFuncionario'];
if(!empty($id)){
	$result_idoso = "DELETE FROM tbfuncionario WHERE codFuncionario='$id'";
	$resultado_idoso = mysqli_query($conn, $result_idoso);
	if(mysqli_affected_rows($conn)){
		header("Location: ../view/listCuidador.php");
        
    }
}
    else{	
	$_SESSION['msg'] = "<p style='color:red;'>Necessário selecionar um cuidador</p>";
	//header("Location: ../view/homeGerente.php");
        echo('teste');
} 
    


?>