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

    // Atualiza um telefone específico baseado na Chave Primária dele (id)
    public function update($idTelefone, $numero, $tipo) {
        try {
            $conn = Conexao::getConexao();
            // Note que aqui o WHERE é no `id` do telefone, e não na `entidade_id`
            $sql = "UPDATE telefone SET numero = ?, tipo = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            
            return $stmt->execute([$numero, $tipo, $idTelefone]);
        } catch (PDOException $e) {
            echo "Erro ao atualizar telefone: " . $e->getMessage();
            return false;
        }
    }

    public function buscarPorEntidade($entidadeTipo, $entidadeId) {
        try {
            $conn = Conexao::getConexao();
            $sql = "SELECT * FROM telefone WHERE entidade_tipo = ? AND entidade_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$entidadeTipo, $entidadeId]);
            
            // Retorna o array associativo com os resultados
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao buscar telefone: " . $e->getMessage();
            return []; // Retorna um array vazio para não quebrar os foreachs na View
        }
    }

    public function deletarPorEntidade($entidadeTipo, $entidadeId) {
        try {
            $conn = Conexao::getConexao();
            $sql = "DELETE FROM telefone WHERE entidade_tipo = ? AND entidade_id = ?";
            $stmt = $conn->prepare($sql);
            
            return $stmt->execute([$entidadeTipo, $entidadeId]);
        } catch (PDOException $e) {
            echo "Erro ao deletar telefone: " . $e->getMessage();
            return false;
        }
    }
}
?>