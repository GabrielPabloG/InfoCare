<?php
session_start();
require_once '../Dao/conexao.php';
require_once '../Model/Gerente.php';
require_once '../Dao/DaoGerente.php';
require_once '../Dao/DaoTelefone.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $gerente = new Gerente();

    // 1. O ID é OBRIGATÓRIO para a atualização (geralmente vem de um <input type="hidden"> no formulário)
    if (empty($_POST['id'])) {
        die("Erro: ID do funcionário não foi fornecido para a atualização.");
    }
    $gerente->setId($_POST['id']);

    // 2. Recebe os dados básicos atualizados
    $gerente->setNome($_POST['nome']);
    $gerente->setCpf($_POST['cpf']);
    $gerente->setSexo($_POST['sexo']);
    $gerente->setNascimento($_POST['nascimento']);
    $gerente->setEmail($_POST['email']);
    $gerente->setSalario($_POST['salario']);

    // 3. Recebe os dados de endereço atualizados
    $gerente->setRua($_POST['rua']);
    $gerente->setBairro($_POST['bairro']);
    $gerente->setCep($_POST['cep']);
    $gerente->setNumeroCasa($_POST['numero_casa']);

    // 4. A REGRA DE OURO DA SENHA:
    if (!empty($_POST['senha'])) {
        // O usuário digitou uma senha nova no formulário de edição
        $senhaSegura = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $gerente->setSenha($senhaSegura);
    } else {
        // O usuário deixou o campo de senha em branco (não quer mudar a senha)
        // Setamos como null para que o DAO saiba que NÃO deve atualizar essa coluna
        $gerente->setSenha(null); 
    }

    // 5. Executa a atualização no Banco
    $daoGerente = new DaoGerente();
    $atualizou = $daoGerente->update($gerente);

    if ($atualizou) {
        // 6. Atualização do Telefone (Polimorfismo)
        if (!empty($_POST['telefone'])) {
            $daoTelefone = new DaoTelefone();
            // A abordagem mais limpa em atualizações N:1 é apagar os antigos e inserir os novos,
            // ou ter um método no DAO que faça um "Upsert" (Update se existir, Insert se não existir).
            // Exemplo apagando os antigos daquele funcionário antes de inserir o novo:
            $daoTelefone->deletarPorEntidade('gerente', $gerente->getId());
            $daoTelefone->insert($_POST['telefone'], 'CELULAR', 'gerente', $gerente->getId());
        }

        header('Location: ../View/homeAdm.php?sucesso=1');
        exit();
    } else {
        header('Location: ../View/homeAdm.php?erro=1');
        exit();
    }
}