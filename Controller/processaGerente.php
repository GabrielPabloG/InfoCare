<?php
	include_once '../Dao/conexao.php';
	$id = mysqli_real_escape_string($conn, $_POST['codGerente']);
	$nome = mysqli_real_escape_string($conn, $_POST['nomeGerente']);
	$sexo = mysqli_real_escape_string($conn, $_POST['sexoGerente']);
    $cpf = mysqli_real_escape_string($conn, $_POST['cpfGerente']);
    $nasc = mysqli_real_escape_string($conn, $_POST['nascGerente']);
    $email = mysqli_real_escape_string($conn, $_POST['emailGerente']);

	//echo "$id - $nome - $detalhes";
	$result_idoso = "UPDATE tbGerente SET nomeGerente='$nome', cpfGerente = '$cpf', sexoGerente = '$sexo', nascGerente = '$nasc', emailGerente = '$email' WHERE codGerente = '$id'";
	
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
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/homeAdm.php'>
				<script type=\"text/javascript\">
					alert(\"Gerente alterado com Sucesso.\");
				</script>
			";	
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/homeAdm.php'>
				<script type=\"text/javascript\">
					alert(\"Gerente não foi alterado com Sucesso.\");
				</script>
                ".$result_idoso."
			";	
		}?>
	</body>
</html>
<?php $conn->close(); ?>