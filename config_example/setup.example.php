<?php
/**
 * Script de criação do primeiro administrador do InfoCare
 * 
 * ⚠️ IMPORTANTE:
 * 1. Copie este arquivo para setup.php
 * 2. Altere o e‑mail e a senha desejados
 * 3. Execute UMA VEZ no navegador: http://localhost/InfocareMain9/setup.php
 * 4. Apague (ou mova) o setup.php imediatamente após o uso!
 */

require_once 'Dao/conexao.php';

try {
    $conn = Conexao::getConexao();
    
    // ⚠️ Altere aqui o e‑mail e a senha do administrador
    $email = 'adm@infocare.com';
    $senha = 'senhaSuperSecreta123';
    
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    
    // Insere na tabela admin (ajuste o nome da tabela se necessário)
    $sql = "INSERT INTO admin (email, senha, nome) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email, $senhaHash, 'Administrador']);
    
    echo "<h2 style='color: green;'>✅ Administrador criado com sucesso!</h2>";
    echo "<p><strong>E‑mail:</strong> " . htmlspecialchars($email) . "</p>";
    echo "<p><strong>Senha:</strong> " . htmlspecialchars($senha) . "</p>";
    echo "<p style='color: red; font-weight: bold;'>⚠️ APAGUE ESTE ARQUIVO (setup.php) AGORA!</p>";
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>Erro ao criar administrador: " . $e->getMessage() . "</p>";
}