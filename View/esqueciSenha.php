<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>InfoCare — Esqueci a Senha</title>
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
        <h1 class="login-tagline">Esqueceu a senha?</h1>
        <p class="login-sub">Informe seu e‑mail cadastrado para receber um link de redefinição.</p>
    </div>

    <div class="login-panel-right">
        <div class="login-card">
            <h2 class="login-card-title">Redefinir Senha</h2>
            <p class="login-card-sub">Um link será enviado para o e‑mail informado.</p>

            <?php if (isset($_GET['erro'])): ?>
                <div class="msg-erro">
                    <?= $_GET['erro'] === 'email_nao_encontrado' ? 'E‑mail não encontrado.' : 'Erro ao processar. Tente novamente.' ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_GET['sucesso'])): ?>
                <div class="msg-sucesso">Link enviado! Verifique sua caixa de entrada (e o spam).</div>
            <?php endif; ?>

            <form action="../Controller/solicitarToken.php" method="post">

                <!-- Campo oculto para armazenar o timestamp de expiração do token -->
                <input type="hidden" name="expira_ms" id="expira_ms" value="">

                <div class="field-group">
                    <label for="email">E‑mail</label>
                    <input type="email" name="email" id="email" placeholder="seu@email.com" required>
                </div>
                <button type="submit" class="btn-login">Enviar link</button>
            </form>
            <p style="text-align:center; margin-top:20px;">
                <a href="../index.php" style="color: var(--primary);">← Voltar ao login</a>
            </p>
        </div>
        <p class="login-footer">InfoCare &copy; <?= date('Y') ?></p>
    </div>
</div>

<!-- Script para definir o valor do campo oculto com o timestamp atual do cliente. -->
<script>
document.querySelector('form').addEventListener('submit', function() {
    document.getElementById('expira_ms').value = Date.now();
});
</script>

</body>
</html>