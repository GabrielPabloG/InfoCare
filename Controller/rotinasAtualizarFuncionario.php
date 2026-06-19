<?php
session_start();
require_once '../Dao/conexao.php';
require_once '../Model/Funcionario.php';
require_once '../Dao/DaoFuncionario.php';
require_once '../Dao/DaoTelefone.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $funcionario = new Funcionario();

    // 1. O ID é OBRIGATÓRIO para a atualização (geralmente vem de um <input type="hidden"> no formulário)
    if (empty($_POST['id'])) {
        die("Erro: ID do funcionário não foi fornecido para a atualização.");
    }
    $funcionario->setId($_POST['id']);

    // 2. Recebe os dados básicos atualizados
    $funcionario->setNome($_POST['nome']);
    $funcionario->setCpf($_POST['cpf']);
    $funcionario->setSexo($_POST['sexo']);
    $funcionario->setNascimento($_POST['nascimento']);
    $funcionario->setEmail($_POST['email']);
    $funcionario->setSalario($_POST['salario']);

    // 3. Recebe os dados de endereço atualizados
    $funcionario->setRua($_POST['rua']);
    $funcionario->setBairro($_POST['bairro']);
    $funcionario->setCep($_POST['cep']);
    $funcionario->setNumeroCasa($_POST['numero_casa']);

    // 4. A REGRA DE OURO DA SENHA:
    if (!empty($_POST['senha'])) {
        // O usuário digitou uma senha nova no formulário de edição
        $senhaSegura = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $funcionario->setSenha($senhaSegura);
    } else {
        // O usuário deixou o campo de senha em branco (não quer mudar a senha)
        // Setamos como null para que o DAO saiba que NÃO deve atualizar essa coluna
        $funcionario->setSenha(null); 
    }

    // 5. Executa a atualização no Banco
    $daoFuncionario = new DaoFuncionario();
    $atualizou = $daoFuncionario->update($funcionario);

    if ($atualizou) {
// Atualização dos Telefones
if (!empty($_POST['telefone']) && is_array($_POST['telefone'])) {
    $daoTelefone = new DaoTelefone();
    
    // Remove todos os telefones antigos desse funcionário
    $daoTelefone->deletarPorEntidade('funcionario', $funcionario->getId());
    
    // Insere cada novo telefone enviado
    foreach ($_POST['telefone'] as $numero) {
        $numero = trim($numero);
        if ($numero !== '') {
            $daoTelefone->insert($numero, 'CELULAR', 'funcionario', $funcionario->getId());
        }
    }
}
        header("Location: ../View/homeFuncionario.php?sucesso=1");
        exit();
    } else {
        echo "Erro ao atualizar funcionário. Por favor, tente novamente.";
    }
}