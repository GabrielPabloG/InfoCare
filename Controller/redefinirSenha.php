<?php
require_once '../Dao/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit;
}

$token = $_POST['token'] ?? '';
$senha = $_POST['senha'] ?? '';
$confirmar = $_POST['confirmar'] ?? '';

if (strlen($senha) < 6) {
    header("Location: ../View/redefinirSenha.php?token=$token&erro=curta");
    exit;
}
if ($senha !== $confirmar) {
    header("Location: ../View/redefinirSenha.php?token=$token&erro=senhas_diferentes");
    exit;
}

$conn = Conexao::getConexao();

// Busca o token válido
$stmt = $conn->prepare("SELECT * FROM password_resets WHERE token = ? AND usado = 0 AND expira_em > NOW() LIMIT 1");
$stmt->execute([$token]);
$reset = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$reset) {
    header("Location: ../View/redefinirSenha.php?token=$token&erro=token_invalido");
    exit;
}

$tipo = $reset['tipo'];
$email = $reset['email'];
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// Atualiza a senha na tabela correta
$tabelasValidas = ['admin', 'gerente', 'funcionario', 'responsavel'];
if (!in_array($tipo, $tabelasValidas)) {
    header("Location: ../View/redefinirSenha.php?token=$token&erro=token_invalido");
    exit;
}

$stmt = $conn->prepare("UPDATE $tipo SET senha = ? WHERE email = ?");
$stmt->execute([$senhaHash, $email]);

// Marca token como usado
$stmt = $conn->prepare("UPDATE password_resets SET usado = 1 WHERE id = ?");
$stmt->execute([$reset['id']]);

header('Location: ../index.php?msg=senha_redefinida');
exit;