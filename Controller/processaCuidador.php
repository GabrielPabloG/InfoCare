<?php
require_once '../Dao/conexao.php';
require_once '../Model/Funcionario.php';
require_once '../Dao/DaoFuncionario.php';
require_once '../Dao/DaoTelefone.php';

// 1. Recebe os dados do formulário
$funcionario = new Funcionario();
$funcionario->setNome($_POST['nome']);
$funcionario->setEmail($_POST['email']);
$funcionario->setCpf($_POST['cpf']);
$senhaSegura = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$funcionario->setSenha($senhaSegura);
$funcionario->setRua($_POST['rua']);
$funcionario->setNumeroCasa($_POST['numero_casa']);
$funcionario->setBairro($_POST['bairro']);
$funcionario->setCep($_POST['cep']);
$funcionario->setSexo($_POST['sexo']);
$funcionario->setNascimento($_POST['nascimento']);
$funcionario->setSalario($_POST['salario']);

// 2. Salva o Funcionario e pega o ID gerado
$daoFuncionario = new DaoFuncionario();
$idFuncionario = $daoFuncionario->insert($funcionario);

if ($idFuncionario) {
    // 3. Salva o telefone associando ao ID do funcionário
if (!empty($_POST['telefone']) && is_array($_POST['telefone'])) {
    $daoTelefone = new DaoTelefone();
    
    // O foreach percorre a lista de telefones enviada pelo formulário
    foreach ($_POST['telefone'] as $numero) {
        
        // Remove espaços vazios e garante que o usuário não enviou um campo em branco
        $numeroLimpo = trim($numero);
        
        if (!empty($numeroLimpo)) {
            // Passa o número limpo, o tipo, a entidade e o ID salvo
            $daoTelefone->insert($numeroLimpo, 'CELULAR', 'funcionario', $idFuncionario);
        }
    }
}
    
    // Redireciona para o sucesso
    header("Location: ../View/listCuidador.php?sucesso=1");
    exit();
} else {
    echo "Erro ao cadastrar funcionário.";
}
?>