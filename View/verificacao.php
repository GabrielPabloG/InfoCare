<?php
if(!isset($_SESSION)) {
    session_start();
}

// Verifica se o usuário está logado usando as chaves que você definiu
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_tipo'])) {
    header("Location: ../index.php");
    exit();
}
?>