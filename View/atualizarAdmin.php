<?php
require_once 'verificacao.php';
require_once '../Dao/conexao.php';

// Apenas o próprio admin pode editar seus dados
if ($_SESSION['user_tipo'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

$conn = Conexao::getConexao();
$idAdmin = $_SESSION['user_id'];

// Busca os dados atuais do admin
$stmt = $conn->prepare("SELECT nome, email FROM admin WHERE id = ?");
$stmt->execute([$idAdmin]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$admin) {
    die('Administrador não encontrado.');
}

$imgPerfil = $_SESSION['foto_perfil'] ?? '../upload/user.png';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>InfoCare — Editar Perfil (Admin)</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/adm.css">
    <link rel="stylesheet" href="../cssModal/css/bootstrap.min.css">
</head>
<body>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <img src="../img/infocare branco.png" alt="InfoCare">
    </div>
    <div class="sidebar-profile">
        <img src="<?= $imgPerfil ?>" alt="Foto" class="sidebar-avatar">
        <div class="sidebar-profile-info">
            <div class="sidebar-profile-name"><?= htmlspecialchars($admin['nome']) ?></div>
            <div class="sidebar-profile-role">Administrador</div>
        </div>
    </div>
    <nav class="sidebar-nav">
        <span class="sidebar-section-label">Gestão</span>
        <a href="homeAdm.php" class="sidebar-link"><i class="icon">⊞</i> Gerentes</a>
        <a href="homeGerente.php" class="sidebar-link"><i class="icon">⊞</i> Idosos</a>
        <a href="listCuidador.php" class="sidebar-link"><i class="icon">⊠</i> Funcionários</a>
        <a href="listarRes.php" class="sidebar-link"><i class="icon">⊟</i> Responsáveis</a>
        <span class="sidebar-section-label">Conta</span>
        <a href="atualizarAdmin.php" class="sidebar-link active"><i class="icon">👤</i> Meus dados</a>
        <form action="../Controller/atualizarFoto.php" method="post" enctype="multipart/form-data" id="formFoto">
            <input type="file" name="foto" id="inputFoto" style="display:none" accept="image/*">
            <label for="inputFoto" class="sidebar-link" style="cursor:pointer; margin-bottom:0"><i class="icon">◎</i> Atualizar foto</label>
        </form>
    </nav>
    <div class="sidebar-footer"><a href="../View/logout.php" class="sidebar-link"><i class="icon">↩</i> Sair</a></div>
</aside>
<div class="sidebar-overlay" id="overlay"></div>

<div class="main-wrapper">
    <header class="topbar">
        <div class="d-flex align-center gap-2">
            <button class="sidebar-toggle" id="sidebarToggle" aria-label="Menu">☰</button>
            <span class="topbar-title">Editar Perfil</span>
        </div>
    </header>
    <main class="page-content">
        <div class="card" style="max-width: 600px; margin: 0 auto;">
            <div class="card-header"><span class="card-header-title">Meus Dados</span></div>
            <div class="card-body">
                <form method="POST" action="../Controller/rotinasAtualizarAdmin.php">
                    <input type="hidden" name="id" value="<?= $idAdmin ?>">

                    <div class="form-group">
                        <label class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($admin['nome']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">E‑mail</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($admin['email']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nova senha <small class="text-muted">(deixe em branco para manter)</small></label>
                        <input type="password" name="senha" class="form-control" placeholder="••••••••">
                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <a href="homeAdm.php" class="btn btn-ghost">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script>
var sidebar = document.getElementById('sidebar');
var overlay = document.getElementById('overlay');
document.getElementById('sidebarToggle').addEventListener('click', function() {
    sidebar.classList.toggle('open');
    overlay.classList.toggle('visible');
});
overlay.addEventListener('click', function() { sidebar.classList.remove('open'); overlay.classList.remove('visible'); });
document.getElementById('inputFoto').addEventListener('change', function() {
    if (!this.files || this.files.length === 0) return;
    if (this.files[0].size / 1024 / 1024 > 10) { alert('Máximo 10MB'); return; }
    document.getElementById('formFoto').submit();
});
</script>
</body>
</html>