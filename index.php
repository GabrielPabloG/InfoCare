<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>InfoCare - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="css/styleLogin.css">
    <link href="css/home.css" type="text/css" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/infocare-logo.png" />
    
    <style>
        /* Estilos simples para as mensagens de erro e sucesso */
        .msg-erro { color: #d9534f; font-weight: bold; margin-bottom: 15px; text-align: center; }
        .msg-sucesso { color: #5cb85c; font-weight: bold; margin-bottom: 15px; text-align: center; }
    </style>
</head>
<body>
    <header class="cabecalho">
        <a href="index.php"> <h1 class="logo"></h1></a>
        <div class="menu">
            <nav>
                <ul></ul>
            </nav>
        </div>
    </header>
    <br><br>

    <form class="box" action="Controller/rotinasLogar.php" method="post">
        <br><br><br><br>
        <h2>O cuidado para quem você ama</h2>
        
        <div class="form">
            <h3>Acesse sua conta</h3>
            <br>
            
            <?php
                if (isset($_GET['erro'])) {
                    if ($_GET['erro'] === 'dados_invalidos') {
                        echo "<div class='msg-erro'>E-mail ou senha incorretos!</div>";
                    } elseif ($_GET['erro'] === 'tipo_invalido') {
                        echo "<div class='msg-erro'>Tipo de usuário não reconhecido.</div>";
                    }
                }
                
                if (isset($_GET['msg'])) {
                    if ($_GET['msg'] === 'conta_excluida') {
                        echo "<div class='msg-sucesso'>Sua conta foi excluída com sucesso.</div>";
                    }
                }
            ?>
            <input class="input100" type="email" id="emailUser" name="email" placeholder="E-mail" required>
            <input class="input100" type="password" id="passwordUser" name="senha" placeholder="Senha" required>
            
            <button class="login100-form-btn" type="submit">Entrar</button>
        </div>
    </form>

</body>
</html>