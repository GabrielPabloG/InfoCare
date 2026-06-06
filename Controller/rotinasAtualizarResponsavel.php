<?php
require_once '../Dao/conexao.php';
require_once '../Model/Responsavel.php';
require_once '../Dao/DaoResponsavel.php'; // Certifique-se de que este DAO foi criado na Fase 3
require_once '../Dao/DaoTelefone.php';

// 1. Instancia o novo Model
$responsavel = new Responsavel();

// 2. Recebe os dados pessoais (removi os sufixos "Pessoa" para padronizar com o Gerente)
$responsavel->setNome($_POST['nome']);
$responsavel->setCpf($_POST['cpf']);
$responsavel->setSexo($_POST['sexo']);
$responsavel->setNascimento($_POST['nascimento']);
$responsavel->setEmail($_POST['email']);

// 3. Aplica o HASH na senha.
$senhaSegura = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$responsavel->setSenha($senhaSegura);

// 4. Recebe os dados de endereço direto no Funcionário
$responsavel->setRua($_POST['rua']);
$responsavel->setBairro($_POST['bairro']);
$responsavel->setCep($_POST['cep']);
$responsavel->setNumeroCasa($_POST['numero_casa']);

// 6. Salva o Funcionário e pega o ID gerado
$daoResponsavel = new DaoResponsavel();
$idResponsavel = $daoResponsavel->insert($responsavel);

if ($idResponsavel) {
    // 7. Salva o telefone associando ao ID do funcionário (Polimorfismo)
    if (!empty($_POST['telefone'])) {
        $daoTelefone = new DaoTelefone();
        $daoTelefone->insert($_POST['telefone'], 'CELULAR', 'responsavel', $idResponsavel);
    }
    
    // Redireciona para a tela de listagem
    header("Location: ../View/listCuidador.php?sucesso=1");
    exit();
} else {
    echo "Erro ao cadastrar funcionário.";
}
?>