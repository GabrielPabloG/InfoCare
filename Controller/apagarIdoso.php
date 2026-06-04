<?php
include_once '../Dao/conexao.php';
$id = $_POST['idIdoso'];
if(!empty($id)){
	$result_idoso = "DELETE FROM tbIdoso WHERE codIdoso='$id'";
	$resultado_idoso = mysqli_query($conn, $result_idoso);
	if(mysqli_affected_rows($conn) || $_SESSION['cargo'] == 'Gerente'){
		header("Location: ../view/homeGerente.php");
        
    } else {
        header("Location: ../view/homeResponsavel.php");
    }
}
    else{	
	$_SESSION['msg'] = "<p style='color:red;'>Necessário selecionar um usuário</p>";
	//header("Location: ../view/homeGerente.php");
        echo('teste');
} 
    


?>