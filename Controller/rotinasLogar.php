<?php
session_start();
require_once '../Dao/DaoAutenticacao.php';

// Verifica se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['email']) && !empty($_POST['senha'])) {
    
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    $daoAuth = new DaoAutenticacao();
    $resultado = $daoAuth->autenticar($email, $senha);

    if ($resultado) {
        // Grava os dados do utilizador logado na Sessão do PHP
        $_SESSION['user_id']   = $resultado['id'];
        $_SESSION['user_nome'] = $resultado['nome'];
        $_SESSION['user_tipo'] = $resultado['tipo']; // ex: 'admin', 'gerente', etc.

        // Redirecionamento dinâmico baseado no tipo de utilizador
        switch ($resultado['tipo']) {
            case 'admin':
                header("Location: ../View/homeAdm.php");
                break;
            case 'gerente':
                header("Location: ../View/homeGerente.php");
                break;
            case 'funcionario':
                header("Location: ../View/homeFuncionario.php");
                break;
            case 'responsavel':
                header("Location: ../View/homeResponsavel.php");
                break;
            default:
                header("Location: ../index.php?erro=tipo_invalido");
                break;
        }
        exit();
        
    } else {
        // Redireciona de volta para o formulário de login com sinal de erro
        header("Location: ../index.php?erro=dados_invalidos");
        exit();
    }
} else {
    // Tentativa de acesso direto ao script sem submeter o formulário
    header("Location: ../index.php");
    exit();
}
?>