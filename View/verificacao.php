<?php
session_start();

// Se não estiver logado, redireciona
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

// Se o tipo de usuário ainda não foi definido, descubra agora
if (empty($_SESSION['user_tipo'])) {
    require_once '../Dao/conexao.php';
    $conn = Conexao::getConexao();

    // Verifica se é admin
    $stmt = $conn->prepare("SELECT COUNT(*) FROM admin WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    if ($stmt->fetchColumn() > 0) {
        $_SESSION['user_tipo'] = 'admin';
    } else {
        // Verifica se é gerente
        $stmt = $conn->prepare("SELECT COUNT(*) FROM gerente WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        if ($stmt->fetchColumn() > 0) {
            $_SESSION['user_tipo'] = 'gerente';
        }
    }
    // Se não for nenhum dos dois, você pode tratar como erro
    if (empty($_SESSION['user_tipo'])) {
        session_destroy();
        header('Location: ../index.php');
        exit;
    }
}

// Busca a foto de perfil usando o tipo e ID corretos
if (!isset($_SESSION['foto_perfil'])) {
    require_once '../Dao/conexao.php'; // já pode ter sido incluído, evite duplicar
    $conn = Conexao::getConexao();

    $tipo = $_SESSION['user_tipo']; 
    $id   = $_SESSION['user_id'];

    $stmtFoto = $conn->prepare(
        "SELECT nome_arquivo FROM foto WHERE entidade_tipo = ? AND entidade_id = ? ORDER BY data_foto DESC LIMIT 1"
    );
    $stmtFoto->execute([$tipo, $id]);
    if ($fotoDb = $stmtFoto->fetch(PDO::FETCH_ASSOC)) {
        $_SESSION['foto_perfil'] = '../upload/' . $fotoDb['nome_arquivo'];
    } else {
        $_SESSION['foto_perfil'] = '../upload/user.png'; // fallback padrão
    }
}