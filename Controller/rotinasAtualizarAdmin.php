<?php
require_once '../View/verificacao.php';
require_once '../Dao/conexao.php';

if ($_SESSION['user_tipo'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../View/homeAdm.php');
    exit;
}

$id   = $_POST['id'] ?? null;
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (!$id || $id != $_SESSION['user_id']) {
    die('Ação não autorizada.');
}

$conn = Conexao::getConexao();

try {
    // Se a senha foi informada, atualiza; senão, mantém a atual
    if (!empty($senha)) {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE admin SET nome = ?, email = ?, senha = ? WHERE id = ?");
        $stmt->execute([$nome, $email, $hash, $id]);
    } else {
        $stmt = $conn->prepare("UPDATE admin SET nome = ?, email = ? WHERE id = ?");
        $stmt->execute([$nome, $email, $id]);
    }

    // Atualiza o nome na sessão para refletir na sidebar
    $_SESSION['user_nome'] = $nome;

    header('Location: ../View/homeAdm.php?sucesso=1');
} catch (PDOException $e) {
    header('Location: ../View/homeAdm.php?erro=1');
}
exit;