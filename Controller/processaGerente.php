<?php
require_once '../Dao/conexao.php';
require_once '../Model/Gerente.php';
require_once '../Dao/DaoGerente.php';
require_once '../Dao/DaoTelefone.php';

// 1. Recebe os dados do formulário
$gerente = new Gerente();
$gerente->setNome($_POST['nome']);
$gerente->setEmail($_POST['email']);
$gerente->setCpf($_POST['cpf']);
$senhaSegura = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$gerente->setSenha($senhaSegura);
$gerente->setRua($_POST['rua']);
$gerente->setNumeroCasa($_POST['numero_casa']);
// ...

// 2. Salva o Gerente e pega o ID gerado
$daoGerente = new DaoGerente();
$idGerente = $daoGerente->insert($gerente);

if ($idGerente) {
    // 3. Salva o telefone associando ao ID do gerente
    if (!empty($_POST['telefone'])) {
        $daoTelefone = new DaoTelefone();
        // Passa o número, o tipo (ex: CELULAR), a entidade ('gerente') e o ID salvo
        $daoTelefone->insert($_POST['telefone'], 'CELULAR', 'gerente', $idGerente);
    }
    
    // Redireciona para o sucesso
    header("Location: ../View/listarRes.php?sucesso=1");
    exit();
} else {
    echo "Erro ao cadastrar gerente.";
}
?>