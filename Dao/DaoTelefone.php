<?php
require_once 'conexao.php';

class DaoTelefone {
    
    // O pulo do gato aqui é receber o tipo e o ID da entidade dona do telefone
    public function insert($numero, $tipo, $entidadeTipo, $entidadeId) {
        try {
            $conn = Conexao::getConexao();
            $sql = "INSERT INTO telefone (numero, tipo, entidade_tipo, entidade_id) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$numero, $tipo, $entidadeTipo, $entidadeId]);
            return true;
        } catch (PDOException $e) {
            // Em produção, registre o erro em um log.
            echo "Erro ao salvar telefone: " . $e->getMessage();
            return false;
        }
    }

    public function buscarPorEntidade($entidadeTipo, $entidadeId) {
            $conn = Conexao::getConexao();
            $sql = "SELECT * FROM telefone WHERE entidade_tipo = ? AND entidade_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$entidadeTipo, $entidadeId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    public function deletarPorEntidade($entidadeTipo, $entidadeId) {
        $conn = Conexao::getConexao();
        $stmt = $conn->prepare(
            "DELETE FROM telefone WHERE entidade_tipo = ? AND entidade_id = ?"
        );
        return $stmt->execute([$entidadeTipo, $entidadeId]);
    }
}