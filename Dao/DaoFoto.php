<?php
require_once 'conexao.php';

class DaoFoto {
    
    // Método que insere a foto e já apaga a antiga para economizar espaço no servidor
    public function salvarFoto($nomeFoto, $entidadeTipo, $entidadeId) {
        try {
            $conn = Conexao::getConexao();
            
            // 1. Busca a foto antiga para apagar o arquivo físico
            $sqlBusca = "SELECT id, nomeFoto FROM foto WHERE entidade_tipo = ? AND entidade_id = ?";
            $stmtBusca = $conn->prepare($sqlBusca);
            $stmtBusca->execute([$entidadeTipo, $entidadeId]);
            $fotoAntiga = $stmtBusca->fetch(PDO::FETCH_ASSOC);

            if ($fotoAntiga) {
                // Apaga o arquivo físico da pasta
                $caminhoArquivo = "../upload/" . $fotoAntiga['nomeFoto'];
                if (file_exists($caminhoArquivo) && $fotoAntiga['nomeFoto'] !== 'user.png') {
                    unlink($caminhoArquivo);
                }
                
                // Apaga o registro antigo do banco
                $sqlDelete = "DELETE FROM foto WHERE id = ?";
                $stmtDelete = $conn->prepare($sqlDelete);
                $stmtDelete->execute([$fotoAntiga['id']]);
            }

            // 2. Insere a foto nova
            $sqlInsert = "INSERT INTO foto (nomeFoto, dataFoto, entidade_tipo, entidade_id) VALUES (?, NOW(), ?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            return $stmtInsert->execute([$nomeFoto, $entidadeTipo, $entidadeId]);
            
        } catch (PDOException $e) {
            echo "Erro no banco de dados ao salvar foto: " . $e->getMessage();
            return false;
        }
    }

    public function buscarPorEntidade($entidadeTipo, $entidadeId) {
        $conn = Conexao::getConexao();
        $stmt = $conn->prepare(
            "SELECT nomeFoto FROM foto WHERE entidade_tipo = ? AND entidade_id = ? ORDER BY dataFoto DESC LIMIT 1"
        );
        $stmt->execute([$entidadeTipo, $entidadeId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>