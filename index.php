<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>InfoCare — Acesso ao Sistema</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/infocare-logo.png">
    <link rel="stylesheet" href="css/styleLogin.css">
</head>
<body>

<div class="login-wrapper">

    <!-- ── Painel esquerdo: identidade ── -->
    <div class="login-panel-left">
        <div class="login-bg-image"></div>
        <span class="deco deco-1"></span>
        <span class="deco deco-2"></span>

        <div class="login-logo" role="img" aria-label="InfoCare"></div>

        <h1 class="login-tagline">
            Cuidado com quem<br>você ama.
        </h1>
        <p class="login-sub">
            Sistema integrado de gestão para casas de repouso.<br>
            Acesse para continuar.
        </p>
    </div>

    <!-- ── Painel direito: formulário ── -->
    <div class="login-panel-right">
        <div class="login-card">
            <h2 class="login-card-title">Bem-vindo</h2>
            <p class="login-card-sub">Entre com suas credenciais para acessar</p>

            <?php
                if (isset($_GET['erro'])) {
                    if ($_GET['erro'] === 'dados_invalidos') {
                        echo "<div class='msg-erro'>E-mail ou senha incorretos.</div>";
                    } elseif ($_GET['erro'] === 'tipo_invalido') {
                        echo "<div class='msg-erro'>Tipo de usuário não reconhecido.</div>";
                    }
                }
                if (isset($_GET['msg'])) {
                    if ($_GET['msg'] === 'conta_excluida') {
                        echo "<div class='msg-sucesso'>Conta excluída com sucesso.</div>";
                    }
                }
            ?>

            <form action="Controller/rotinasLogar.php" method="post" novalidate>

                <div class="field-group">
                    <label for="emailUser">E-mail</label>
                    <input
                        type="email"
                        id="emailUser"
                        name="email"
                        placeholder="seu@email.com"
                        autocomplete="email"
                        required
                    >
                </div>

                <div class="field-group">
                    <label for="passwordUser">Senha</label>
                    <input
                        type="password"
                        id="passwordUser"
                        name="senha"
                        placeholder="••••••••"
                        autocomplete="current-password"
                        required
                    >
                </div>

                <button class="btn-login" type="submit">Entrar</button>

            </form>

            <p style="text-align:center; margin-top:20px;">
                <a href="View/esqueciSenha.php" style="color: var(--primary);">Esqueci minha senha</a>
        </div>

        <p class="login-footer">InfoCare &copy; <?= date('Y') ?> — Todos os direitos reservados</p>
    </div>

</div>

</body>
</html>
