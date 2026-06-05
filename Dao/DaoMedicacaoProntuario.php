<?php
require_once 'conexao.php';

class DaoMedicacaoProntuario {
    
    // Associa um medicamento a um prontuário fixo
    public function vincularMedicamento($medicacaoId, $prontuarioFixoId) {
        try {
            $conn = Conexao::getConexao();
            
            $sql = "INSERT INTO medicacao_prontuario (medicacao_id, prontuario_fixo_id) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$medicacaoId, $prontuarioFixoId]);
            
            return true;
        } catch (PDOException $e) {
            echo "Erro ao vincular medicamento ao prontuário: " . $e->getMessage();
            return false;
        }
    }

    // Desvincula um medicamento de um prontuário (para quando o médico suspender o remédio)
    public function desvincularMedicamento($medicacaoId, $prontuarioFixoId) {
        try {
            $conn = Conexao::getConexao();
            
            $sql = "DELETE FROM medicacao_prontuario WHERE medicacao_id = ? AND prontuario_fixo_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$medicacaoId, $prontuarioFixoId]);
            
            return true;
        } catch (PDOException $e) {
            echo "Erro ao remover medicamento: " . $e->getMessage();
            return false;
        }
    }

    // Busca todos os IDs de medicamentos de um prontuário específico
    public function listarMedicamentosDoProntuario($prontuarioFixoId) {
        $conn = Conexao::getConexao();
        $sql = "SELECT medicacao_id FROM medicacao_prontuario WHERE prontuario_fixo_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$prontuarioFixoId]);
        
        // Retorna todos os registros em forma de array
        return $stmt->fetchAll(); 
    }
}