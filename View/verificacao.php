<?php
session_start();

// Se não estiver logado, redireciona para o login
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_tipo'])) {
    session_destroy();
    header('Location: ../index.php');
    exit;
}

// Se a foto de perfil ainda não foi carregada, busca e guarda na sessão
if (!isset($_SESSION['foto_perfil'])) {
    require_once '../Dao/conexao.php';
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
        $_SESSION['foto_perfil'] = '../upload/user.png';
    }
}