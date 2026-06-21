<?php
require_once '../Dao/conexao.php';

// Namespaces do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['email'])) {
    header('Location: ../View/esqueciSenha.php?erro=1');
    exit;
}

$email = trim($_POST['email']);
$conn = Conexao::getConexao();

// Remove tokens expirados há mais de 30 dias
$conn->exec("DELETE FROM password_resets WHERE expira_em < NOW() - INTERVAL 30 DAY");

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

// Recebe o timestamp local do usuário (milissegundos)
$expira_ms = $_POST['expira_ms'] ?? 0;

// Calcula a expiração: +1 hora (3600 segundos) a partir do instante do clique
$expira_timestamp = (int)($expira_ms / 1000) + 3600;

// Gera o DATETIME no formato UTC para o banco
$expira = gmdate('Y-m-d H:i:s', $expira_timestamp);

// Gera token único e seguro
$token = bin2hex(random_bytes(32));

// Salva o token
$stmt = $conn->prepare("INSERT INTO password_resets (email, token, tipo, expira_em) VALUES (?, ?, ?, ?)");
$stmt->execute([$email, $token, $tipo, $expira]);

// Link de redefinição
$link = "http://localhost/InfocareMain9/View/redefinirSenha.php?token=$token";

// Mensagem do e‑mail
$assunto = "Redefinição de Senha - InfoCare";
$mensagem = "
Olá {$usuario['nome']},

Você solicitou a redefinição de senha no sistema InfoCare.
Acesse o link abaixo para criar uma nova senha:

$link

Este link é válido por 1 hora.

Se você não solicitou esta alteração, ignore este e‑mail.
";

// Envio com PHPMailer
try {
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';                     // charset da mensagem
    $mail->Encoding = 'base64';                   // codificação segura para acentos
    $mail->setLanguage('pt_br');                  // mensagens de erro em português (opcional)
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'pgabpabg@gmail.com';
    $mail->Password   = 'ikjb tfuu resg whyc';   // senha de app do Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    $mail->setFrom('no-reply@infocare.com', 'InfoCare');
    $mail->addAddress($email, $usuario['nome']);
    $mail->Subject = $assunto;
    $mail->Body    = $mensagem;

    $mail->send();
    header('Location: ../View/esqueciSenha.php?sucesso=1');
} catch (Exception $e) {
    // Em desenvolvimento, mostre o link para testes
    //echo "Erro ao enviar e-mail: " . $e->getMessage();
    header("Location: ../View/esqueciSenha.php?erro=Erro ao processar. Tente novamente.");
}
exit;