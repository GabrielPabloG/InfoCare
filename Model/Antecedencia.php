<?php

class Antecedencia {
    private $id;
    private $declinio_cognitivo;
    private $dificuldade_fala;
    private $audicao;
    private $ave;
    private $tce;
    private $hipertensao;
    private $hipotireoidismo;
    private $diabetes_tipo;
    private $cancer_tipo;
    private $local_fratura;
    private $cirurgia_tipo;
    private $outras_patologias;
    private $usa_medicamento;
    private $tratamento_realizado;

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getDeclinioCognitivo() {
        return $this->declinio_cognitivo;
    }
    public function setDeclinioCognitivo($declinio_cognitivo) {
        $this->declinio_cognitivo = $declinio_cognitivo;
    }

    public function getDificuldadeFala() {
        return $this->dificuldade_fala;
    }
    public function setDificuldadeFala($dificuldade_fala) {
        $this->dificuldade_fala = $dificuldade_fala;
    }

    public function getAudicao() {
        return $this->audicao;
    }
    public function setAudicao($audicao) {
        $this->audicao = $audicao;
    }

    public function getAve() {
        return $this->ave;
    }
    public function setAve($ave) {
        $this->ave = $ave;
    }

    public function getTce() {
        return $this->tce;
    }
    public function setTce($tce) {
        $this->tce = $tce;
    }

    public function getHipertensao() {
        return $this->hipertensao;
    }
    public function setHipertensao($hipertensao) {
        $this->hipertensao = $hipertensao;
    }

    public function getHipotireoidismo() {
        return $this->hipotireoidismo;
    }
    public function setHipotireoidismo($hipotireoidismo) {
        $this->hipotireoidismo = $hipotireoidismo;
    }

    public function getDiabetesTipo() {
        return $this->diabetes_tipo;
    }
    public function setDiabetesTipo($diabetes_tipo) {
        $this->diabetes_tipo = $diabetes_tipo;
    }

    public function getCancerTipo() {
        return $this->cancer_tipo;
    }
    public function setCancerTipo($cancer_tipo) {
        $this->cancer_tipo = $cancer_tipo;
    }

    public function getLocalFratura() {
        return $this->local_fratura;
    }
    public function setLocalFratura($local_fratura) {
        $this->local_fratura = $local_fratura;
    }

    public function getCirugiaTipo() {
        return $this->cirurgia_tipo;
    }
    public function setCirugiaTipo($cirurgia_tipo) {
        $this->cirurgia_tipo = $cirurgia_tipo;
    }

    public function getOutrasPatologias() {
        return $this->outras_patologias;
    }
    public function setOutrasPatologias($outras_patologias) {
        $this->outras_patologias = $outras_patologias;
    }

    public function getUsaMedicamento() {
        return $this->usa_medicamento;
    }
    public function setUsaMedicamento($usa_medicamento) {
        $this->usa_medicamento = $usa_medicamento;
    }

    public function getTratamentoRealizado() {
        return $this->tratamento_realizado;
    }
    public function setTratamentoRealizado($tratamento_realizado) {
        $this->tratamento_realizado = $tratamento_realizado;
    }
}
