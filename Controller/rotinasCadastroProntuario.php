<?php
	require_once '../Model/Prontuario.php';
    require_once '../Model/Idoso.php';
	require_once '../Dao/DaoProntuario.php';
	
	$prontuario = new Prontuario();
    $idoso = new Idoso();
	$daoProntuario = new DaoProntuario();
	
	$prontuario->setDescProntuario($_POST['descProntuario']);
    $prontuario->setDataProntuario($_POST['dataProntuario']);
    $idoso->setCodIdoso($_POST['codIdoso']);

	echo($daoProntuario->cadastrarProntuario($prontuario, $idoso));
	
?>