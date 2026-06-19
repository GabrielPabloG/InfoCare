<?php
require_once '../Dao/conexao.php';
require_once '../Model/Responsavel.php';
require_once '../Dao/DaoResponsavel.php';
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
if (!empty($_POST['telefone']) && is_array($_POST['telefone'])) {
    $daoTelefone = new DaoTelefone();
    
    // O foreach percorre a lista de telefones enviada pelo formulário
    foreach ($_POST['telefone'] as $numero) {
        
        // Remove espaços vazios e garante que o usuário não enviou um campo em branco
        $numeroLimpo = trim($numero);
        
        if (!empty($numeroLimpo)) {
            // Passa o número limpo, o tipo, a entidade e o ID salvo
            $daoTelefone->insert($numeroLimpo, 'CELULAR', 'responsavel', $idResponsavel);
        }
    }
}   
    // Redireciona para a tela de listagem
    header("Location: ../View/listarRes.php?sucesso=1");
    exit();
} else {
    echo "Erro ao cadastrar funcionário.";
}
?>