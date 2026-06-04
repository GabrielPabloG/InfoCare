<?php
	include_once '../Dao/conexao.php';
	$id = mysqli_real_escape_string($conn, $_POST['codIdoso']);
	$nome = mysqli_real_escape_string($conn, $_POST['nomeIdoso']);
	$detalhes = mysqli_real_escape_string($conn, $_POST['sexoIdoso']);
	//echo "$id - $nome - $detalhes";
	$result_idoso = "UPDATE tbIdoso SET nomeIdoso='$nome', sexoIdoso =  '$detalhes' WHERE codIdoso = '$id'";
	
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
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/homeGerente.php'>
				<script type=\"text/javascript\">
					alert(\"Idoso alterado com Sucesso.\");
				</script>
			";	
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/homeGerente.php'>
				<script type=\"text/javascript\">
					alert(\"Idoso não foi alterado com Sucesso.\");
				</script>
			";	
		}?>
	</body>
</html>
<?php $conn->close(); ?>