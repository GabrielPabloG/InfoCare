<?php
session_start();
require_once '../Dao/conexao.php';
require_once '../Dao/DaoFoto.php';

// 1. Trava de Segurança
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_tipo'])) {
    die("Erro: Você precisa estar logado para alterar a foto.");
}

// 2. Verifica se o formulário enviou um arquivo via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {
    
    $arquivo = $_FILES['foto'];

    // 3. Verifica se não houve erros no upload do PHP (ex: arquivo muito grande)
    if ($arquivo['error'] === UPLOAD_ERR_OK) {
        
        // Pega a extensão do arquivo (ex: jpg, png)
        $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg', 'jpeg', 'png'];

        // 4. Validação de Segurança (Evita upload de arquivos maliciosos como .php)
        if (in_array($extensao, $permitidas)) {
            
            // Cria um nome único (Ex: 8f7d9a... .jpg)
            $novoNome = md5(time() . rand(0, 9999)) . '.' . $extensao;
            $diretorio = "../upload/";

            // Cria a pasta upload se ela não existir
            if (!is_dir($diretorio)) {
                mkdir($diretorio, 0777, true);
            }

            // 5. Move o arquivo da pasta temporária do servidor para a pasta definitiva
            if (move_uploaded_file($arquivo['tmp_name'], $diretorio . $novoNome)) {
                
                // 6. Salva no Banco de Dados
                $daoFoto = new DaoFoto();
                $salvou = $daoFoto->salvarFoto($novoNome, $_SESSION['user_tipo'], $_SESSION['user_id']);

                if ($salvou) {
                    // Redireciona de volta para a Home (Dinâmico para Gerente ou outros cargos)
                    if ($_SESSION['user_tipo'] === 'gerente' || $_SESSION['user_tipo'] === 'admin') {
                        header("Location: ../View/homeGerente.php?atualizado=1");
                    } else {
                        // Se no futuro houver home do Cuidador ou Responsável:
                        header("Location: ../View/home.php?atualizado=1"); 
                    }
                    exit();
                } else {
                    echo "Erro ao vincular a foto no banco de dados.";
                }
            } else {
                echo "Erro ao mover o arquivo para a pasta upload.";
            }
        } else {
            echo "Formato de imagem inválido. Use apenas JPG, JPEG ou PNG.";
        }
    } else {
        echo "Erro no upload da imagem. Código do erro: " . $arquivo['error'];
    }
} else {
    // Acesso direto pela URL sem formulário
    header("Location: ../index.php");
    exit();
}
?>