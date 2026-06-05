<?php

class DaoFoto { 
    public function insert($nome_arquivo, $dataFoto, $entidadeTipo, $entidadeId) {
        try {
            $conn = Conexao::getConexao();
            $sql = "INSERT INTO foto (nome_arquivo, data_foto, entidade_tipo, entidade_id) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nome_arquivo, $dataFoto, $entidadeTipo, $entidadeId]);
            return true;
        } catch (PDOException $e) {
            // Em produção, registre o erro em um log.
            echo "Erro ao salvar foto: " . $e->getMessage();
            return false;
        }

    public function buscarPorEntidade($entidadeTipo, $entidadeId) {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM foto WHERE entidade_tipo = ? AND entidade_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$entidadeTipo, $entidadeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    }
}