<?php
	require_once '../Model/Idoso.php';
    require_once '../Model/Pessoa.php';
	require_once '../Dao/DaoIdoso.php';

	$idoso = new Idoso();
    $pessoa = new Pessoa();
	$daoIdoso = new DaoIdoso();
	
	$idoso->setNomeIdoso($_POST['nomeIdoso']);
    $idoso->setCpfIdoso($_POST['cpfIdoso']);
    $idoso->setSexoIdoso($_POST['sexoIdoso']);
    $idoso->setNascIdoso($_POST['nascIdoso']);
    $pessoa->setCpfPessoa($_POST['cpfPessoa']);
    

	echo($daoIdoso->atualizarIdoso($idoso, $pessoa));
	
?>
?>