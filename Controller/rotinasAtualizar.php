<?php
	require_once '../Model/Pessoa.php';
    require_once '../Model/Funcionario.php';
	require_once '../Dao/DaoPessoa.php';
	
    $conexao = abrirConexao();
	$pessoa = new Pessoa();
    $funcionario = new Funcionario();
	$daoPessoa = new DaoPessoa();

    //$telefones = $_POST['telefonePessoa'];
    //$email = $_POST['emailPessoa'];
	
	$pessoa->setNomePessoa($_POST['nomePessoa']);
    $pessoa->setCpfPessoa($_POST['cpfPessoa']);
    $pessoa->setSexoPessoa($_POST['sexoPessoa']);
    $pessoa->setNascPessoa($_POST['nascPessoa']);
    $pessoa->setEmailPessoa($_POST['emailPessoa']);
    $pessoa->setSenhaPessoa($_POST['senhaPessoa']);
    $pessoa->setRuaEndereco($_POST['ruaEndereco']);
    $pessoa->setBairroEndereco($_POST['bairroEndereco']);
    $pessoa->setCepEndereco($_POST['cepEndereco']);
    $pessoa->setNumCasaEndereco($_POST['numCasaEndereco']);
    
    $pessoa->setTelefonePessoa($_POST['telefonePessoa']);

	echo($daoPessoa->atualizarPessoa($pessoa));
	
?>