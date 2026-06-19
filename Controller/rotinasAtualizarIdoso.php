<?php
require_once '../View/verificacao.php';
require_once '../Dao/conexao.php';

// Acesso restrito a admin e gerente
if ($_SESSION['user_tipo'] !== 'admin' && $_SESSION['user_tipo'] !== 'gerente') {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit;
}

// Validação simples
if (empty($_POST['id']) || empty($_POST['nome']) || empty($_POST['sexo'])) {
    header('Location: ../View/homeGerente.php?erro=1');
    exit;
}

$conn = Conexao::getConexao();

try {
    $stmt = $conn->prepare("UPDATE idoso SET nome = :nome, sexo = :sexo WHERE id = :id");
    $stmt->execute([
        ':nome' => $_POST['nome'],
        ':sexo' => $_POST['sexo'],
        ':id'   => $_POST['id']
    ]);

    header('Location: ../View/homeGerente.php?sucesso=1');
} catch (PDOException $e) {
    // Log do erro se necessário
    header('Location: ../View/homeGerente.php?erro=1');
}
exit;