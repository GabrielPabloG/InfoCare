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
        try {
            $conn = Conexao::getConexao();
            
            // O INNER JOIN junta a tabela associativa com a tabela de medicamentos
            // Assim, ele traz o nome, a dosagem, o horário, etc.
            $sql = "SELECT m.* FROM medicacao m
                    INNER JOIN medicacao_prontuario mp ON m.id = mp.medicacao_id
                    WHERE mp.prontuario_fixo_id = ?";
                    
            $stmt = $conn->prepare($sql);
            $stmt->execute([$prontuarioFixoId]);
            
            // Retorna a lista completa de remédios prontinha para ser exibida no HTML
            return $stmt->fetchAll(PDO::FETCH_ASSOC); 
            
        } catch (PDOException $e) {
            echo "Erro ao listar medicamentos: " . $e->getMessage();
            return [];
        }
    }
}