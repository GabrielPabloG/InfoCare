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
$gerente->setBairro($_POST['bairro']);
$gerente->setCep($_POST['cep']);
$gerente->setSexo($_POST['sexo']);
$gerente->setNascimento($_POST['nascimento']);
$gerente->setSalario($_POST['salario']);

// 2. Salva o Gerente e pega o ID gerado
$daoGerente = new DaoGerente();
$idGerente = $daoGerente->insert($gerente);

if ($idGerente) {
    // 3. Salva o telefone associando ao ID do gerente
if (!empty($_POST['telefone']) && is_array($_POST['telefone'])) {
    $daoTelefone = new DaoTelefone();
    
    // O foreach percorre a lista de telefones enviada pelo formulário
    foreach ($_POST['telefone'] as $numero) {
        
        // Remove espaços vazios e garante que o usuário não enviou um campo em branco
        $numeroLimpo = trim($numero);
        
        if (!empty($numeroLimpo)) {
            // Passa o número limpo, o tipo, a entidade e o ID salvo
            $daoTelefone->insert($numeroLimpo, 'CELULAR', 'gerente', $idGerente);
        }
    }
}
    
    // Redireciona para o sucesso
    header("Location: ../View/homeAdm.php?sucesso=1");
    exit();
} else {
    echo "Erro ao cadastrar gerente.";
}
?>