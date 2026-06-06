<?php
// Inicia a sessão caso precise pegar o ID de quem está logado
session_start();

require_once '../Dao/conexao.php';
require_once '../Model/Idoso.php';
require_once '../Dao/DaoIdoso.php';

// Verifica se a requisição veio mesmo de um formulário POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $idoso = new Idoso();

    // 1. Recebe os dados básicos do Idoso
    $idoso->setNome($_POST['nome']);
    $idoso->setCpf($_POST['cpf']);
    $idoso->setSexo($_POST['sexo']);
    
    // Usando o setter que corrigimos na Fase 2
    $idoso->setNascimento($_POST['nascimento']); 

    // 2. Tratamento das Chaves Estrangeiras (FKs)
    
    // A) O Responsável: 
    // Pode vir de um <select> no formulário ou, se o próprio responsável estiver 
    // logado cadastrando o idoso, você pega da sessão:
    if (!empty($_POST['responsavel_id'])) {
        $idoso->setResponsavelId($_POST['responsavel_id']);
    } elseif (isset($_SESSION['user_tipo']) && $_SESSION['user_tipo'] === 'responsavel') {
        $idoso->setResponsavelId($_SESSION['user_id']);
    } else {
        // Se não tiver responsável, o banco vai bloquear a inserção (FK restrita)
        die("Erro: É obrigatório vincular um responsável ao idoso.");
    }

    // B) O Prontuário Fixo:
    // Geralmente, o idoso é cadastrado primeiro, e o prontuário é criado depois.
    // Portanto, no momento do cadastro do idoso, o ID do prontuário pode ser nulo.
    // (A menos que seu formulário seja gigante e crie tudo na mesma tela).
    $prontuarioId = !empty($_POST['prontuario_fixo_id']) ? $_POST['prontuario_fixo_id'] : null;
    $idoso->setProntuarioFixoId($prontuarioId);

    // 3. Persistência no Banco de Dados
    $daoIdoso = new DaoIdoso();
    $idGerado = $daoIdoso->insert($idoso);

    if ($idGerado) {
        // Cadastro bem-sucedido. Redireciona para a listagem ou para a tela de criar o prontuário.
        header("Location: ../View/listarRes.php?sucesso=1");
        exit();
    } else {
        // Falha no banco de dados. Retorna para o formulário com erro.
        header("Location: ../View/cadastroIdoso.php?erro=1");
        exit();
    }

} else {
    // Tentativa de acesso direto à URL do controlador sem enviar o formulário
    header("Location: ../index.php");
    exit();
}
?>