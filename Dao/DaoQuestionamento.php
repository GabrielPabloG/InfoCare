<?php
require_once 'conexao.php';
require_once '../Model/Questionamento.php';

class DaoQuestionamento {
    public function insert(Questionamento $questionamento) {
        $conn = Conexao::getConexao();
        $sql = "INSERT INTO questionamento (peso, altura, pressao_arterial, pulsacao, respiracao, temperatura, dextro, spo2, usa_oculos, protese_auditiva, carteira_vacinacao, tabagista, etilista, dependencia_etilismo, tipo_sanguineo, usa_protese_dentaria, marca_protese, modelo_protese, usa_medicamento_continuo, usa_substancia_psicoativa, alergia_medicamento, convenio, encaminhamento_hospitalar, atividade_manual) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $questionamento->getPeso(),
            $questionamento->getAltura(),
            $questionamento->getPressaoArterial(),
            $questionamento->getPulsacao(),
            $questionamento->getRespiracao(),
            $questionamento->getTemperatura(),
            $questionamento->getDextro(),
            $questionamento->getSpo2(),
            $questionamento->getUsaOculos(),
            $questionamento->getProteseAuditiva(),
            $questionamento->getCarteiraVacinacao(),
            $questionamento->getTabagista(),
            $questionamento->getEtilista(),
            $questionamento->getDependenciaEtilismo(),
            $questionamento->getTipoSanguineo(),
            $questionamento->getUsaProteseDentaria(),
            $questionamento->getMarcaProtese(),
            $questionamento->getModeloProtese(),
            $questionamento->getUsaMedicamentoContinuo(),
            $questionamento->getUsaSubstanciaPsicoativa(),
            $questionamento->getAlergiaMedicamento(),
            $questionamento->getConvenio(),
            $questionamento->getEncaminhamentoHospitalar(),
            $questionamento->getAtividadeManual()
        ]);
        
        return $conn->lastInsertId();
    }

    public function update(Questionamento $questionamento) {
        $conn = Conexao::getConexao();
        $sql = "UPDATE questionamento SET peso = ?, altura = ?, pressao_arterial = ?, pulsacao = ?, respiracao = ?, temperatura = ?, dextro = ?, spo2 = ?, usa_oculos = ?, protese_auditiva = ?, carteira_vacinacao = ?, tabagista = ?, etilista = ?, dependencia_etilismo = ?, tipo_sanguineo = ?, usa_protese_dentaria = ?, marca_protese = ?, modelo_protese = ?, usa_medicamento_continuo = ?, usa_substancia_psicoativa = ?, alergia_medicamento = ?, convenio = ?, encaminhamento_hospitalar = ?, atividade_manual = ? 
                WHERE id = ?";
        
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            $questionamento->getPeso(),
            $questionamento->getAltura(),
            $questionamento->getPressaoArterial(),
            $questionamento->getPulsacao(),
            $questionamento->getRespiracao(),
            $questionamento->getTemperatura(),
            $questionamento->getDextro(),
            $questionamento->getSpo2(),
            $questionamento->getUsaOculos(),
            $questionamento->getProteseAuditiva(),
            $questionamento->getCarteiraVacinacao(),
            $questionamento->getTabagista(),
            $questionamento->getEtilista(),
            $questionamento->getDependenciaEtilismo(),
            $questionamento->getTipoSanguineo(),
            $questionamento->getUsaProteseDentaria(),
            $questionamento->getMarcaProtese(),
            $questionamento->getModeloProtese(),
            $questionamento->getUsaMedicamentoContinuo(),
            $questionamento->getUsaSubstanciaPsicoativa(),
            $questionamento->getAlergiaMedicamento(),
            $questionamento->getConvenio(),
            $questionamento->getEncaminhamentoHospitalar(),
            $questionamento->getAtividadeManual(),
            $questionamento->getId()
        ]);
    }

    public function delete($id) {
        $conn = Conexao::getConexao();
        $sql = "DELETE FROM questionamento WHERE id = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getById($id) {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM questionamento WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $questionamento = new Questionamento();
            $questionamento->setId($row['id']);
            $questionamento->setPeso($row['peso']);
            $questionamento->setAltura($row['altura']);
            $questionamento->setPressaoArterial($row['pressao_arterial']);
            $questionamento->setPulsacao($row['pulsacao']);
            $questionamento->setRespiracao($row['respiracao']);
            $questionamento->setTemperatura($row['temperatura']);
            $questionamento->setDextro($row['dextro']);
            $questionamento->setSpo2($row['spo2']);
            $questionamento->setUsaOculos($row['usa_oculos']);
            $questionamento->setProteseAuditiva($row['protese_auditiva']);
            $questionamento->setCarteiraVacinacao($row['carteira_vacinacao']);
            $questionamento->setTabagista($row['tabagista']);
            $questionamento->setEtilista($row['etilista']);
            $questionamento->setDependenciaEtilismo($row['dependencia_etilismo']);
            $questionamento->setTipoSanguineo($row['tipo_sanguineo']);
            $questionamento->setUsaProteseDentaria($row['usa_protese_dentaria']);
            $questionamento->setMarcaProtese($row['marca_protese']);
            $questionamento->setModeloProtese($row['modelo_protese']);
            $questionamento->setUsaMedicamentoContinuo($row['usa_medicamento_continuo']);
            $questionamento->setUsaSubstanciaPsicoativa($row['usa_substancia_psicoativa']);
            $questionamento->setAlergiaMedicamento($row['alergia_medicamento']);
            $questionamento->setConvenio($row['convenio']);
            $questionamento->setEncaminhamentoHospitalar($row['encaminhamento_hospitalar']);
            $questionamento->setAtividadeManual($row['atividade_manual']);
            return $questionamento;
        }
        return null;
    }

    public function listAll() {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM questionamento";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $questionamentos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $questionamento = new Questionamento();
            $questionamento->setId($row['id']);
            $questionamento->setPeso($row['peso']);
            $questionamento->setAltura($row['altura']);
            $questionamento->setPressaoArterial($row['pressao_arterial']);
            $questionamento->setPulsacao($row['pulsacao']);
            $questionamento->setRespiracao($row['respiracao']);
            $questionamento->setTemperatura($row['temperatura']);
            $questionamento->setDextro($row['dextro']);
            $questionamento->setSpo2($row['spo2']);
            $questionamento->setUsaOculos($row['usa_oculos']);
            $questionamento->setProteseAuditiva($row['protese_auditiva']);
            $questionamento->setCarteiraVacinacao($row['carteira_vacinacao']);
            $questionamento->setTabagista($row['tabagista']);
            $questionamento->setEtilista($row['etilista']);
            $questionamento->setDependenciaEtilismo($row['dependencia_etilismo']);
            $questionamento->setTipoSanguineo($row['tipo_sanguineo']);
            $questionamento->setUsaProteseDentaria($row['usa_protese_dentaria']);
            $questionamento->setMarcaProtese($row['marca_protese']);
            $questionamento->setModeloProtese($row['modelo_protese']);
            $questionamento->setUsaMedicamentoContinuo($row['usa_medicamento_continuo']);
            $questionamento->setUsaSubstanciaPsicoativa($row['usa_substancia_psicoativa']);
            $questionamento->setAlergiaMedicamento($row['alergia_medicamento']);
            $questionamento->setConvenio($row['convenio']);
            $questionamento->setEncaminhamentoHospitalar($row['encaminhamento_hospitalar']);
            $questionamento->setAtividadeManual($row['atividade_manual']);
            $questionamentos[] = $questionamento;
        }
        return $questionamentos;
    }
}
