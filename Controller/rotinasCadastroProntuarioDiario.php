<?php
session_start();
require_once '../Dao/DaoProntuarioDiario.php';

// 1. Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// 2. Verifica se a requisição veio pelo formulário corretamente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['observacao']) && isset($_POST['idoso_id'])) {
    
    $observacao = trim($_POST['observacao']);
    $idosoId = $_POST['idoso_id'];
    $funcionarioId = $_SESSION['user_id'];  // Pega o ID de quem está logado
    
    // 3. Validação simples para não aceitar texto vazio
    if (empty($observacao)) {
        die("Erro: A observação não pode estar vazia.");
    }
    
    // 4. Instancia o DAO e salva no banco
    $dao = new DaoProntuarioDiario();
    $sucesso = $dao->registrarEvolucao($idosoId, $funcionarioId, $observacao);
    
    // 5. Redireciona com base no sucesso
    if ($sucesso) {
        // Volta para a tela inicial do cuidador mostrando uma mensagem de sucesso
        header("Location: ../View/homeFuncionario.php?atualizado=1");
        exit();
    } else {
        echo "Ocorreu um erro ao salvar o registro no banco de dados. Tente novamente.";
    }
    
} else {
    // Se tentarem acessar o link diretamente sem enviar POST
    header("Location: ../View/homeFuncionario.php");
    exit();
}
?>