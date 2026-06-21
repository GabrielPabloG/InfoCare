<?php
require_once '../Dao/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['email'])) {
    header('Location: ../View/esqueciSenha.php?erro=1');
    exit;
}

$email = trim($_POST['email']);
$conn = Conexao::getConexao();

// Procura o e‑mail em todas as tabelas de usuários
$tabelas = [
    'admin'        => 'admin',
    'gerente'      => 'gerente',
    'funcionario'  => 'funcionario',
    'responsavel'  => 'responsavel'
];

$usuario = null;
$tipo = null;

foreach ($tabelas as $tabela => $tipoUsuario) {
    $stmt = $conn->prepare("SELECT id, nome, email FROM $tabela WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $usuario = $row;
        $tipo = $tipoUsuario;
        break;
    }
}

if (!$usuario) {
    header('Location: ../View/esqueciSenha.php?erro=email_nao_encontrado');
    exit;
}

// Gera token único e segura
$token = bin2hex(random_bytes(32));
$expira = date('Y-m-d H:i:s', strtotime('+1 hour'));

// Salva o token
$stmt = $conn->prepare("INSERT INTO password_resets (email, token, tipo, expira_em) VALUES (?, ?, ?, ?)");
$stmt->execute([$email, $token, $tipo, $expira]);

// Link de redefinição
$link = "http://localhost/InfocareMain9/View/redefinirSenha.php?token=$token";

// Envia e‑mail
$assunto = "Redefinição de Senha - InfoCare";
$mensagem = "
Olá {$usuario['nome']},

Você solicitou a redefinição de senha no sistema InfoCare.
Acesse o link abaixo para criar uma nova senha:

$link

Este link é válido por 1 hora.

Se você não solicitou esta alteração, ignore este e‑mail.
";

$headers = "From: no-reply@infocare.com\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$enviado = mail($email, $assunto, $mensagem, $headers);

if ($enviado) {
    header('Location: ../View/esqueciSenha.php?sucesso=1');
} else {
    // Em ambiente de desenvolvimento, mostre o link (remova em produção)
    header("Location: ../View/esqueciSenha.php?erro=envio&link=$token");
}
exit;