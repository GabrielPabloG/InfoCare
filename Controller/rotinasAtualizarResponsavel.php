<?php
session_start();
require_once '../Dao/conexao.php';
require_once '../Model/Responsavel.php';
require_once '../Dao/DaoResponsavel.php';
require_once '../Dao/DaoTelefone.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $responsavel = new Responsavel();

    // 1. O ID é OBRIGATÓRIO para a atualização (geralmente vem de um <input type="hidden"> no formulário)
    if (empty($_POST['id'])) {
        die("Erro: ID do funcionário não foi fornecido para a atualização.");
    }
    $responsavel->setId($_POST['id']);

    // 2. Recebe os dados básicos atualizados
    $responsavel->setNome($_POST['nome']);
    $responsavel->setCpf($_POST['cpf']);
    $responsavel->setSexo($_POST['sexo']);
    $responsavel->setNascimento($_POST['nascimento']);
    $responsavel->setEmail($_POST['email']);

    // 3. Recebe os dados de endereço atualizados
    $responsavel->setRua($_POST['rua']);
    $responsavel->setBairro($_POST['bairro']);
    $responsavel->setCep($_POST['cep']);
    $responsavel->setNumeroCasa($_POST['numero_casa']);

    // 4. A REGRA DE OURO DA SENHA:
    if (!empty($_POST['senha'])) {
        // O usuário digitou uma senha nova no formulário de edição
        $senhaSegura = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $responsavel->setSenha($senhaSegura);
    } else {
        // O usuário deixou o campo de senha em branco (não quer mudar a senha)
        // Setamos como null para que o DAO saiba que NÃO deve atualizar essa coluna
        $responsavel->setSenha(null); 
    }

    // 5. Executa a atualização no Banco
    $daoResponsavel = new DaoResponsavel();
    $atualizou = $daoResponsavel->update($responsavel);

    if ($atualizou) {
        // 6. Atualização do Telefone (Polimorfismo)
if (!empty($_POST['telefone']) && is_array($_POST['telefone'])) {
    $daoTelefone = new DaoTelefone();
    
    // Remove todos os telefones antigos desse funcionário
    $daoTelefone->deletarPorEntidade('responsavel', $responsavel->getId());
    
    // Insere cada novo telefone enviado
    foreach ($_POST['telefone'] as $numero) {
        $numero = trim($numero);
        if ($numero !== '') {
            $daoTelefone->insert($numero, 'CELULAR', 'responsavel', $responsavel->getId());
        }
    }
}

        header("Location: ../View/listarRes.php?sucesso=1");
        exit();
    } else {
        header("Location: ../View/listarRes.php?erro=1");
        exit();
    }
}