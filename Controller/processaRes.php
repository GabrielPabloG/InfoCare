<?php
	include_once '../Dao/conexao.php';
	$id = mysqli_real_escape_string($conn, $_POST['codResponsavel']);
	$nome = mysqli_real_escape_string($conn, $_POST['nomeResponsavel']);
	$sexo = mysqli_real_escape_string($conn, $_POST['sexoResponsavel']);
    $cpf = mysqli_real_escape_string($conn, $_POST['cpfResponsavel']);
    $nasc = mysqli_real_escape_string($conn, $_POST['nascResponsavel']);
    $email = mysqli_real_escape_string($conn, $_POST['emailResponsavel']);

	//echo "$id - $nome - $detalhes";
	$result_idoso = "UPDATE tbResponsavel SET nomeResponsavel='$nome', sexoResponsavel = '$sexo' WHERE codResponsavel = '$id'";
	
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
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/listarRes.php'>
				<script type=\"text/javascript\">
					alert(\"Responsável alterado com Sucesso.\");
				</script>
			";	
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/listarRes.php'>
				<script type=\"text/javascript\">
					alert(\"Responsável não foi alterado com Sucesso.\");
				</script>
			";	
		}?>
	</body>
</html>
<?php $conn->close(); ?>