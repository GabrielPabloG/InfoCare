<?php
	require_once '../Model/Idoso.php';
    require_once '../Model/Pessoa.php';
	require_once '../Dao/DaoIdoso.php';

	$idoso = new Idoso();
    $pessoa = new Pessoa();
	$daoIdoso = new DaoIdoso();
	
	$idoso->setNome($_POST['nomeIdoso']);
	$idoso->setCpf($_POST['cpfIdoso']);
	$idoso->setSexo($_POST['sexoIdoso']);
	$idoso->setNascimento($_POST['nascIdoso']);
    $pessoa->setCpfPessoa($_POST['cpfPessoa']);
    

	echo($daoIdoso->atualizarIdoso($idoso, $pessoa));
	
?>
?>