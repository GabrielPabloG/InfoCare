<?php
	require_once '../Model/Pessoa.php';
    require_once '../Model/Idoso.php';
    require_once '../Model/Funcionario.php';
	require_once '../Dao/DaoPessoa.php';
    require_once '../Dao/DaoIdoso.php';
	
    $conexao = abrirConexao();
	$pessoa = new Pessoa();
    $idoso = new Idoso();
    $funcionario = new Funcionario();
	$daoPessoa = new DaoPessoa();
    $daoIdoso = new DaoIdoso();

    //$telefones = $_POST['telefonePessoa'];
    //$email = $_POST['emailPessoa'];
	
    $idoso->setNomeIdoso($_POST['nomeIdoso']);
    $idoso->setCpfIdoso($_POST['cpfIdoso']);
    $idoso->setSexoIdoso($_POST['sexoIdoso']);
    $idoso->setNascIdoso($_POST['nascIdoso']);

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

	echo($daoPessoa->cadastrarPessoa($pessoa, $funcionario));
    //echo($daoIdoso->cadastrarIdoso($idoso, $pessoa));
	
?>