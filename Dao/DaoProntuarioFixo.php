<?php
require_once 'conexao.php';
require_once '../Model/ProntuarioFixo.php';

class DaoProntuarioFixo {
    
    public function insert(ProntuarioFixo $prontuario) {
        try {
            $conn = Conexao::getConexao();
            
            $sql = "INSERT INTO prontuario_fixo (
                        data_emissao, antecedencia_id, questionamento_id, pele_id, 
                        pulmonar_id, alimentacao_id, locomocao_id, relacionamento_id, 
                        exame_id, eliminacao_id
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                $prontuario->getDataEmissao(),
                $prontuario->getAntecedenciaId(),
                $prontuario->getQuestionamentoId(),
                $prontuario->getPeleId(),
                $prontuario->getPulmonarId(),
                $prontuario->getAlimentacaoId(),
                $prontuario->getLocomocaoId(),
                $prontuario->getRelacionamentoId(),
                $prontuario->getExameId(),
                $prontuario->getEliminacaoId()
            ]);
            
            // Retorna o ID gerado para podermos vincular ao Idoso depois
            return $conn->lastInsertId(); 
            
        } catch (PDOException $e) {
            echo "Erro ao salvar prontuário fixo: " . $e->getMessage();
            return false;
        }
    }

    // Exemplo de busca para quando formos exibir o prontuário na View
    public function findById($id) {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM prontuario_fixo WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(); // Retorna o array com as chaves estrangeiras
    }
}