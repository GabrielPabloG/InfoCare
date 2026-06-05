<?php

class Questionamento {
    private $id;
    private $peso;
    private $altura;
    private $pressao_arterial;
    private $pulsacao;
    private $respiracao;
    private $temperatura;
    private $dextro;
    private $spo2;
    private $usa_oculos;
    private $protese_auditiva;
    private $carteira_vacinacao;
    private $tabagista;
    private $etilista;
    private $dependencia_etilismo;
    private $tipo_sanguineo;
    private $usa_protese_dentaria;
    private $marca_protese;
    private $modelo_protese;
    private $usa_medicamento_continuo;
    private $usa_substancia_psicoativa;
    private $alergia_medicamento;
    private $convenio;
    private $encaminhamento_hospitalar;
    private $atividade_manual;

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getPeso() {
        return $this->peso;
    }
    public function setPeso($peso) {
        $this->peso = $peso;
    }

    public function getAltura() {
        return $this->altura;
    }
    public function setAltura($altura) {
        $this->altura = $altura;
    }

    public function getPressaoArterial() {
        return $this->pressao_arterial;
    }
    public function setPressaoArterial($pressao_arterial) {
        $this->pressao_arterial = $pressao_arterial;
    }

    public function getPulsacao() {
        return $this->pulsacao;
    }
    public function setPulsacao($pulsacao) {
        $this->pulsacao = $pulsacao;
    }

    public function getRespiracao() {
        return $this->respiracao;
    }
    public function setRespiracao($respiracao) {
        $this->respiracao = $respiracao;
    }

    public function getTemperatura() {
        return $this->temperatura;
    }
    public function setTemperatura($temperatura) {
        $this->temperatura = $temperatura;
    }

    public function getDextro() {
        return $this->dextro;
    }
    public function setDextro($dextro) {
        $this->dextro = $dextro;
    }

    public function getSpo2() {
        return $this->spo2;
    }
    public function setSpo2($spo2) {
        $this->spo2 = $spo2;
    }

    public function getUsaOculos() {
        return $this->usa_oculos;
    }
    public function setUsaOculos($usa_oculos) {
        $this->usa_oculos = $usa_oculos;
    }

    public function getProteseAuditiva() {
        return $this->protese_auditiva;
    }
    public function setProteseAuditiva($protese_auditiva) {
        $this->protese_auditiva = $protese_auditiva;
    }

    public function getCarteiraVacinacao() {
        return $this->carteira_vacinacao;
    }
    public function setCarteiraVacinacao($carteira_vacinacao) {
        $this->carteira_vacinacao = $carteira_vacinacao;
    }

    public function getTabagista() {
        return $this->tabagista;
    }
    public function setTabagista($tabagista) {
        $this->tabagista = $tabagista;
    }

    public function getEtilista() {
        return $this->etilista;
    }
    public function setEtilista($etilista) {
        $this->etilista = $etilista;
    }

    public function getDependenciaEtilismo() {
        return $this->dependencia_etilismo;
    }
    public function setDependenciaEtilismo($dependencia_etilismo) {
        $this->dependencia_etilismo = $dependencia_etilismo;
    }

    public function getTipoSanguineo() {
        return $this->tipo_sanguineo;
    }
    public function setTipoSanguineo($tipo_sanguineo) {
        $this->tipo_sanguineo = $tipo_sanguineo;
    }

    public function getUsaProteseDentaria() {
        return $this->usa_protese_dentaria;
    }
    public function setUsaProteseDentaria($usa_protese_dentaria) {
        $this->usa_protese_dentaria = $usa_protese_dentaria;
    }

    public function getMarcaProtese() {
        return $this->marca_protese;
    }
    public function setMarcaProtese($marca_protese) {
        $this->marca_protese = $marca_protese;
    }

    public function getModeloProtese() {
        return $this->modelo_protese;
    }
    public function setModeloProtese($modelo_protese) {
        $this->modelo_protese = $modelo_protese;
    }

    public function getUsaMedicamentoContinuo() {
        return $this->usa_medicamento_continuo;
    }
    public function setUsaMedicamentoContinuo($usa_medicamento_continuo) {
        $this->usa_medicamento_continuo = $usa_medicamento_continuo;
    }

    public function getUsaSubstanciaPsicoativa() {
        return $this->usa_substancia_psicoativa;
    }
    public function setUsaSubstanciaPsicoativa($usa_substancia_psicoativa) {
        $this->usa_substancia_psicoativa = $usa_substancia_psicoativa;
    }

    public function getAlergiaMedicamento() {
        return $this->alergia_medicamento;
    }
    public function setAlergiaMedicamento($alergia_medicamento) {
        $this->alergia_medicamento = $alergia_medicamento;
    }

    public function getConvenio() {
        return $this->convenio;
    }
    public function setConvenio($convenio) {
        $this->convenio = $convenio;
    }

    public function getEncaminhamentoHospitalar() {
        return $this->encaminhamento_hospitalar;
    }
    public function setEncaminhamentoHospitalar($encaminhamento_hospitalar) {
        $this->encaminhamento_hospitalar = $encaminhamento_hospitalar;
    }

    public function getAtividadeManual() {
        return $this->atividade_manual;
    }
    public function setAtividadeManual($atividade_manual) {
        $this->atividade_manual = $atividade_manual;
    }
}
