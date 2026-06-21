<?php
require_once '../View/verificacao.php';
require_once '../Dao/conexao.php';

// Apenas admin e gerente podem excluir responsáveis
if ($_SESSION['user_tipo'] !== 'admin' && $_SESSION['user_tipo'] !== 'gerente') {
    header('Location: ../View/listarRes.php?erro=permissao');
    exit;
}

if (empty($_GET['id'])) {
    header('Location: ../View/listarRes.php?erro=1');
    exit;
}

$id = (int) $_GET['id'];
$conn = Conexao::getConexao();

try {
    // Verifica se há idosos vinculados
    $stmt = $conn->prepare("SELECT COUNT(*) FROM idoso WHERE responsavel_id = ?");
    $stmt->execute([$id]);
    $totalVinculados = $stmt->fetchColumn();

    if ($totalVinculados > 0) {
        // Exibe mensagem informando que não pode excluir
        header("Location: ../View/listarRes.php?erro=vinculado&total=$totalVinculados");
        exit;
    }

    $conn->beginTransaction();

    // Remove telefones associados
    $stmt = $conn->prepare("DELETE FROM telefone WHERE entidade_tipo = 'responsavel' AND entidade_id = ?");
    $stmt->execute([$id]);

    // Remove o responsável
    $stmt = $conn->prepare("DELETE FROM responsavel WHERE id = ?");
    $stmt->execute([$id]);

    $conn->commit();
    header('Location: ../View/listarRes.php?sucesso=1');
} catch (PDOException $e) {
    $conn->rollBack();
    header('Location: ../View/listarRes.php?erro=1');
}
exit;