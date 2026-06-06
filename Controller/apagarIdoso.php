<?php
session_start();
require_once '../Dao/conexao.php';
require_once '../Dao/DaoIdoso.php';

// 1. TRAVA DE SEGURANÇA (Autorização)
// Verifica se o usuário está logado e se o tipo dele permite excluir idosos.
// Usei in_array para permitir que tanto 'admin' quanto 'gerente' façam isso.
if (!isset($_SESSION['user_tipo']) || !in_array($_SESSION['user_tipo'], ['admin', 'gerente'])) {
    die("Erro de Acesso: Você não tem permissão para realizar esta ação.");
}

// 2. VALIDAÇÃO DO PARÂMETRO
// Garante que o ID foi enviado pela URL e é um número válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Erro: ID do idoso inválido ou não fornecido.");
}

$id = $_GET['id']; 

// 3. EXECUÇÃO
$daoIdoso = new DaoIdoso();

// O banco de dados (se estiver com ON DELETE CASCADE configurado)
// se encarregará de apagar o prontuário diário vinculado a esse idoso automaticamente.
if ($daoIdoso->delete($id)) {
    // Redireciona para a tela onde os idosos/responsáveis são listados
    header("Location: ../View/listarRes.php?excluido=1"); 
    exit(); 
} else {
    // Em caso de falha (ex: banco offline ou restrição de chave estrangeira)
    echo "Erro ao tentar excluir o idoso do banco de dados.";
}
?>