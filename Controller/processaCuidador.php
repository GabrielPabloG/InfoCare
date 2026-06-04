<?php
	include_once '../Dao/conexao.php';
	$id = mysqli_real_escape_string($conn, $_POST['codFuncionario']);
	$nome = mysqli_real_escape_string($conn, $_POST['nomeFuncionario']);
	$sexo = mysqli_real_escape_string($conn, $_POST['sexoFuncionario']);
    $cpf = mysqli_real_escape_string($conn, $_POST['cpfFuncionario']);
    $nasc = mysqli_real_escape_string($conn, $_POST['nascFuncionario']);
    $email = mysqli_real_escape_string($conn, $_POST['emailFuncionario']);

	//echo "$id - $nome - $detalhes";
	$result_idoso = "UPDATE tbfuncionario SET nomeFuncionario='$nome', sexoFuncionario = '$sexo', cpfFuncionario = '$cpf', nascFuncionario = '$nasc', emailFuncionario = '$email' WHERE codFuncionario = '$id'";
	
	$resultado_idoso = mysqli_query($conn, $result_idoso);	
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
	</head>

	<body> <?php
		if(mysqli_affected_rows($conn) != 0){
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/listCuidador.php'>
				<script type=\"text/javascript\">
					alert(\"Cuidador alterado com Sucesso.\");
				</script>
			";	
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/listCuidador.php'>
				<script type=\"text/javascript\">
					alert(\"Cuidador não foi alterado com Sucesso.\");
				</script>
			";	
		}?>
	</body>
</html>
<?php $conn->close(); ?>