<?php
$token = $_GET['token'] ?? '';
if (empty($token)) {
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>InfoCare — Redefinir Senha</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/styleLogin.css">
</head>
<body>
<div class="login-wrapper">
    <div class="login-panel-left">
        <span class="deco deco-1"></span>
        <span class="deco deco-2"></span>
        <div class="login-logo" role="img" aria-label="InfoCare"></div>
        <h1 class="login-tagline">Crie uma nova senha</h1>
        <p class="login-sub">Escolha uma senha forte para acessar o sistema.</p>
    </div>

    <div class="login-panel-right">
        <div class="login-card">
            <h2 class="login-card-title">Nova Senha</h2>
            <p class="login-card-sub">Digite a nova senha abaixo.</p>

            <?php if (isset($_GET['erro'])): ?>
                <div class="msg-erro">
                    <?php
                    switch ($_GET['erro']) {
                        case 'token_invalido': echo 'Token inválido ou expirado.'; break;
                        case 'senhas_diferentes': echo 'As senhas não conferem.'; break;
                        case 'curta': echo 'A senha deve ter no mínimo 6 caracteres.'; break;
                        default: echo 'Erro ao redefinir senha.';
                    }
                    ?>
                </div>
            <?php endif; ?>

            <form action="../Controller/redefinirSenha.php" method="post">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                <div class="field-group">
                    <label for="senha">Nova senha</label>
                    <input type="password" name="senha" id="senha" placeholder="••••••••" required minlength="6">
                </div>
                <div class="field-group">
                    <label for="confirmar">Confirmar senha</label>
                    <input type="password" name="confirmar" id="confirmar" placeholder="••••••••" required minlength="6">
                </div>
                <button type="submit" class="btn-login">Redefinir senha</button>
            </form>
            <p style="text-align:center; margin-top:20px;">
                <a href="../index.php" style="color: var(--primary);">← Voltar ao login</a>
            </p>
        </div>
        <p class="login-footer">InfoCare &copy; <?= date('Y') ?></p>
    </div>
</div>
</body>
</html>