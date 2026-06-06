<?php
require_once '../Dao/conexao.php';
require_once '../Model/Funcionario.php';
require_once '../Dao/DaoFuncionario.php'; // Certifique-se de que este DAO foi criado na Fase 3
require_once '../Dao/DaoTelefone.php';

// 1. Instancia o novo Model
$funcionario = new Funcionario();

// 2. Recebe os dados pessoais (removi os sufixos "Pessoa" para padronizar com o Gerente)
$funcionario->setNome($_POST['nome']);
$funcionario->setCpf($_POST['cpf']);
$funcionario->setSexo($_POST['sexo']);
$funcionario->setNascimento($_POST['nascimento']);
$funcionario->setEmail($_POST['email']);

// 3. Aplica o HASH na senha.
$senhaSegura = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$funcionario->setSenha($senhaSegura);

// 4. Recebe os dados de endereço direto no Funcionário
$funcionario->setRua($_POST['rua']);
$funcionario->setBairro($_POST['bairro']);
$funcionario->setCep($_POST['cep']);
$funcionario->setNumeroCasa($_POST['numero_casa']);

// 5. Dados específicos do Funcionário (Cargo foi removido do BD, mantemos só salário)
$funcionario->setSalario($_POST['salario']);

// ATENÇÃO: A tabela funcionario tem uma FK gerente_id. 
// Geralmente pegamos isso da sessão de quem está logado cadastrando ele:
// session_start();
// $funcionario->setGerenteId($_SESSION['user_id']); 

// 6. Salva o Funcionário e pega o ID gerado
$daoFuncionario = new DaoFuncionario();
$idFuncionario = $daoFuncionario->insert($funcionario);

if ($idFuncionario) {
    // 7. Salva o telefone associando ao ID do funcionário (Polimorfismo)
    if (!empty($_POST['telefone'])) {
        $daoTelefone = new DaoTelefone();
        $daoTelefone->insert($_POST['telefone'], 'CELULAR', 'funcionario', $idFuncionario);
    }
    
    // Redireciona para a tela de listagem
    header("Location: ../View/listCuidador.php?sucesso=1");
    exit();
} else {
    echo "Erro ao cadastrar funcionário.";
}
?>