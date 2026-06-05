<?php
require_once 'conexao.php';
require_once '../Model/Antecedencia.php';

class DaoAntecedencia {
    public function insert(Antecedencia $antecedencia) {
        $conn = Conexao::getConexao();
        $sql = "INSERT INTO antecedencia (declinio_cognitivo, dificuldade_fala, audicao, ave, tce, hipertensao, hipotireoidismo, diabetes_tipo, cancer_tipo, local_fratura, cirurgia_tipo, outras_patologias, usa_medicamento, tratamento_realizado) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $antecedencia->getDeclinioCognitivo(),
            $antecedencia->getDificuldadeFala(),
            $antecedencia->getAudicao(),
            $antecedencia->getAve(),
            $antecedencia->getTce(),
            $antecedencia->getHipertensao(),
            $antecedencia->getHipotireoidismo(),
            $antecedencia->getDiabetesTipo(),
            $antecedencia->getCancerTipo(),
            $antecedencia->getLocalFratura(),
            $antecedencia->getCirugiaTipo(),
            $antecedencia->getOutrasPatologias(),
            $antecedencia->getUsaMedicamento(),
            $antecedencia->getTratamentoRealizado()
        ]);
        
        return $conn->lastInsertId();
    }

    public function update(Antecedencia $antecedencia) {
        $conn = Conexao::getConexao();
        $sql = "UPDATE antecedencia SET declinio_cognitivo = ?, dificuldade_fala = ?, audicao = ?, ave = ?, tce = ?, hipertensao = ?, hipotireoidismo = ?, diabetes_tipo = ?, cancer_tipo = ?, local_fratura = ?, cirurgia_tipo = ?, outras_patologias = ?, usa_medicamento = ?, tratamento_realizado = ? 
                WHERE id = ?";
        
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            $antecedencia->getDeclinioCognitivo(),
            $antecedencia->getDificuldadeFala(),
            $antecedencia->getAudicao(),
            $antecedencia->getAve(),
            $antecedencia->getTce(),
            $antecedencia->getHipertensao(),
            $antecedencia->getHipotireoidismo(),
            $antecedencia->getDiabetesTipo(),
            $antecedencia->getCancerTipo(),
            $antecedencia->getLocalFratura(),
            $antecedencia->getCirugiaTipo(),
            $antecedencia->getOutrasPatologias(),
            $antecedencia->getUsaMedicamento(),
            $antecedencia->getTratamentoRealizado(),
            $antecedencia->getId()
        ]);
    }

    public function delete($id) {
        $conn = Conexao::getConexao();
        $sql = "DELETE FROM antecedencia WHERE id = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getById($id) {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM antecedencia WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $antecedencia = new Antecedencia();
            $antecedencia->setId($row['id']);
            $antecedencia->setDeclinioCognitivo($row['declinio_cognitivo']);
            $antecedencia->setDificuldadeFala($row['dificuldade_fala']);
            $antecedencia->setAudicao($row['audicao']);
            $antecedencia->setAve($row['ave']);
            $antecedencia->setTce($row['tce']);
            $antecedencia->setHipertensao($row['hipertensao']);
            $antecedencia->setHipotireoidismo($row['hipotireoidismo']);
            $antecedencia->setDiabetesTipo($row['diabetes_tipo']);
            $antecedencia->setCancerTipo($row['cancer_tipo']);
            $antecedencia->setLocalFratura($row['local_fratura']);
            $antecedencia->setCirugiaTipo($row['cirurgia_tipo']);
            $antecedencia->setOutrasPatologias($row['outras_patologias']);
            $antecedencia->setUsaMedicamento($row['usa_medicamento']);
            $antecedencia->setTratamentoRealizado($row['tratamento_realizado']);
            return $antecedencia;
        }
        return null;
    }

    public function listAll() {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM antecedencia";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $antecedencias = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $antecedencia = new Antecedencia();
            $antecedencia->setId($row['id']);
            $antecedencia->setDeclinioCognitivo($row['declinio_cognitivo']);
            $antecedencia->setDificuldadeFala($row['dificuldade_fala']);
            $antecedencia->setAudicao($row['audicao']);
            $antecedencia->setAve($row['ave']);
            $antecedencia->setTce($row['tce']);
            $antecedencia->setHipertensao($row['hipertensao']);
            $antecedencia->setHipotireoidismo($row['hipotireoidismo']);
            $antecedencia->setDiabetesTipo($row['diabetes_tipo']);
            $antecedencia->setCancerTipo($row['cancer_tipo']);
            $antecedencia->setLocalFratura($row['local_fratura']);
            $antecedencia->setCirugiaTipo($row['cirurgia_tipo']);
            $antecedencia->setOutrasPatologias($row['outras_patologias']);
            $antecedencia->setUsaMedicamento($row['usa_medicamento']);
            $antecedencia->setTratamentoRealizado($row['tratamento_realizado']);
            $antecedencias[] = $antecedencia;
        }
        return $antecedencias;
    }
}
