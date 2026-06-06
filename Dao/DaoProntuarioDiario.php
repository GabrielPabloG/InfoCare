<?php
require_once 'conexao.php';

class DaoProntuarioDiario {
    
    // Salva a evolução diária do paciente
    public function registrarEvolucao($idosoId, $funcionarioId, $observacao) {
        try {
            $conn = Conexao::getConexao();
            // NOW() pega a data e hora exata do servidor no momento do clique
            $sql = "INSERT INTO prontuario_diario (idoso_id, funcionario_id, observacao, data_registro) 
                    VALUES (?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            
            return $stmt->execute([$idosoId, $funcionarioId, $observacao]);
            
        } catch (PDOException $e) {
            echo "Erro ao registrar prontuário diário: " . $e->getMessage();
            return false;
        }
    }

    // Busca todo o histórico de um paciente específico (do mais recente pro mais antigo)
    public function listarHistoricoDoPaciente($idosoId) {
        try {
            $conn = Conexao::getConexao();
            $sql = "SELECT pd.*, f.nome AS nome_cuidador 
                    FROM prontuario_diario pd
                    INNER JOIN funcionario f ON pd.funcionario_id = f.id
                    WHERE pd.idoso_id = ? 
                    ORDER BY pd.data_registro DESC";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute([$idosoId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            echo "Erro ao buscar histórico: " . $e->getMessage();
            return [];
        }
    }
}
?>