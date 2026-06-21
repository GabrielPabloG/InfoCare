<?php
/**
 * Configuração de e‑mail — modelo
 * 
 * Copie este arquivo para configEmail.php e preencha com os dados reais.
 * O arquivo configEmail.php NÃO deve ser versionado (está no .gitignore).
 */

define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_USER', 'seuemail@gmail.com');          // seu e‑mail real
define('MAIL_PASS', 'sua_senha_de_app_do_gmail');   // senha de app (Gmail)
define('MAIL_PORT', 587);
define('MAIL_FROM_ADDRESS', 'no-reply@infocare.com');
define('MAIL_FROM_NAME', 'InfoCare');

// ⚠️ Não use a senha normal da conta Google.
// Gere uma "senha de app" em: https://myaccount.google.com/apppasswords
// Obrigatório ter verificação em duas etapas ativada.