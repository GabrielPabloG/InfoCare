<?php
require_once '../View/verificacao.php';
require_once '../Dao/conexao.php';

// Apenas admin e gerente podem excluir idosos
if ($_SESSION['user_tipo'] !== 'admin' && $_SESSION['user_tipo'] !== 'gerente') {
    header('Location: ../index.php');
    exit;
}

if (empty($_GET['id'])) {
    header('Location: ../View/homeGerente.php?erro=1');
    exit;
}

$id = (int) $_GET['id'];
$conn = Conexao::getConexao();

try {
    $conn->beginTransaction();

    // 0. Buscar o prontuário fixo vinculado ao idoso
    $stmt = $conn->prepare("SELECT prontuario_fixo_id FROM idoso WHERE id = ?");
    $stmt->execute([$id]);
    $idoso = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$idoso) {
        header('Location: ../View/homeGerente.php?erro=1');
        exit;
    }

    $prontuarioId = $idoso['prontuario_fixo_id'];

    // 1. Remover telefones do idoso (tabela polimórfica)
    $stmt = $conn->prepare("DELETE FROM telefone WHERE entidade_tipo = 'idoso' AND entidade_id = ?");
    $stmt->execute([$id]);

    // 2. Remover fotos do idoso
    $stmt = $conn->prepare("DELETE FROM foto WHERE entidade_tipo = 'idoso' AND entidade_id = ?");
    $stmt->execute([$id]);

    // 3. Remover medicamentos (se existir tabela medicamento vinculada à antecedencia)
    if ($prontuarioId) {
        $stmt = $conn->prepare("
            DELETE m FROM medicamento m
            INNER JOIN antecedencia a ON m.antecedencia_id = a.id
            INNER JOIN prontuario_fixo pf ON pf.antecedencia_id = a.id
            WHERE pf.id = ?
        ");
        $stmt->execute([$prontuarioId]);
    }

    // 4. Excluir as avaliações (ordem inversa das dependências)
    if ($prontuarioId) {
        $tabelas = [
            'eliminacao',
            'exame',
            'relacionamento',
            'locomocao',
            'alimentacao',
            'pulmonar',
            'pele',
            'questionamento',
            'antecedencia'
        ];

        foreach ($tabelas as $tabela) {
            $stmt = $conn->prepare("
                DELETE $tabela FROM $tabela
                INNER JOIN prontuario_fixo ON prontuario_fixo.{$tabela}_id = $tabela.id
                WHERE prontuario_fixo.id = ?
            ");
            $stmt->execute([$prontuarioId]);
        }

        // 5. Excluir o prontuário fixo
        $stmt = $conn->prepare("DELETE FROM prontuario_fixo WHERE id = ?");
        $stmt->execute([$prontuarioId]);
    }

    // 6. Finalmente, excluir o idoso
    $stmt = $conn->prepare("DELETE FROM idoso WHERE id = ?");
    $stmt->execute([$id]);

    $conn->commit();
    header('Location: ../View/homeGerente.php?sucesso=1');
} catch (PDOException $e) {
    $conn->rollBack();
    header('Location: ../View/homeGerente.php?erro=1');
}
exit;