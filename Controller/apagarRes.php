<?php
session_start();
require_once '../Dao/conexao.php';
require_once '../Dao/DaoResponsavel.php';

// 1. TRAVA DE SEGURANÇA (Autorização)
// Verifica se alguém está logado e se esse alguém é um Administrador.
// Ajuste 'admin' caso a regra do seu sistema permita que outros cargos apaguem gerentes.
if (!isset($_SESSION['user_tipo']) || $_SESSION['user_tipo'] !== 'gerente' && $_SESSION['user_tipo'] !== 'admin') {
    die("Erro de Acesso: Você não tem permissão para realizar esta ação.");
}

// 2. VALIDAÇÃO DO PARÂMETRO
// Garante que o ID foi enviado e é estritamente numérico
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Erro: ID inválido ou não fornecido.");
}

$id = $_GET['id']; 

// 3. EXECUÇÃO
$daoResponsavel = new DaoResponsavel();

if ($daoResponsavel->delete($id)) {
        header("Location: ../View/listarRes.php?excluido=1");
    exit(); 
} else {
    echo "Erro ao tentar excluir o responsável do banco de dados.";
}
?>