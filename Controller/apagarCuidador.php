<?php
session_start();
require_once '../Dao/conexao.php';
require_once '../Dao/DaoFuncionario.php';

// 1. TRAVA DE SEGURANÇA (Autorização)
// Verifica se alguém está logado e se esse alguém é um Administrador.
if (!isset($_SESSION['user_tipo']) || $_SESSION['user_tipo'] !== 'admin' && $_SESSION['user_tipo'] !== 'gerente') {
    die("Erro de Acesso: Você não tem permissão para realizar esta ação.");
	destroyed_session();
	header("Location: ../index.php");
	exit;
}

// 2. VALIDAÇÃO DO PARÂMETRO
// Garante que o ID foi enviado e é estritamente numérico
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Erro: ID inválido ou não fornecido.");
}

$id = $_GET['id']; 

// 3. EXECUÇÃO
$daoFuncionario = new DaoFuncionario();

if ($daoFuncionario->delete($id)) {
        header("Location: ../View/listCuidador.php?excluido=1");
    exit(); // Sempre coloque exit() após um header de redirecionamento
} else {
    echo "Erro ao tentar excluir o funcionário do banco de dados.";
}
?>