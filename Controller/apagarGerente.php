<?php
include_once '../Dao/conexao.php';
$id = $_POST['idGerente'];
if(!empty($id)){
	$result_idoso = "DELETE FROM tbGerente WHERE codGerente='$id'";
	$resultado_idoso = mysqli_query($conn, $result_idoso);
	if(mysqli_affected_rows($conn)){
		header("Location: ../view/homeAdm.php");
        
    }
}
    else{	
	$_SESSION['msg'] = "<p style='color:red;'>Necessário selecionar um usuário</p>";
	//header("Location: ../view/homeGerente.php");
        echo('teste');
} 
    


?>