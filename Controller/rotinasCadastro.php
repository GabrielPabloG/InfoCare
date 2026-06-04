<?php
	require_once 'Gerente.php';
	require_once 'DaoGerente.php';
	
	$gerente = new Gerente();
	$daoGerente = new DaoGerente();
	
	$gerente->setNomeGerente($_POST['nomeGerente']);
    $gerente->setCpfGerente($_POST['cpfGerente']);
    $gerente->setSexoGerente($_POST['sexoGerente']);
    $gerente->setNascGerente($_POST['nascGerente']);
    $gerente->setSalarioGerente($_POST['salarioGerente']);
    $gerente->setEmailGerente($_POST['emailGerente']);
    $gerente->setSenhaGerente($_POST['senhaGerente']);

	echo($daoGerente->cadastrarGerente($gerente));
	
?>