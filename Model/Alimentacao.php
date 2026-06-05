<?php

class Alimentacao {
    private $id;
    private $alimentacao_sozinho;
    private $dificuldade_degluticao;
    private $uso_sonda;
    private $restricao_alimentar;
    private $preferencia_alimentar;

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getAlimentacaoSozinho() {
        return $this->alimentacao_sozinho;
    }
    public function setAlimentacaoSozinho($alimentacao_sozinho) {
        $this->alimentacao_sozinho = $alimentacao_sozinho;
    }

    public function getDificuldadeDegluticao() {
        return $this->dificuldade_degluticao;
    }
    public function setDificuldadeDegluticao($dificuldade_degluticao) {
        $this->dificuldade_degluticao = $dificuldade_degluticao;
    }

    public function getUsoSonda() {
        return $this->uso_sonda;
    }
    public function setUsoSonda($uso_sonda) {
        $this->uso_sonda = $uso_sonda;
    }

    public function getRestricaoAlimentar() {
        return $this->restricao_alimentar;
    }
    public function setRestricaoAlimentar($restricao_alimentar) {
        $this->restricao_alimentar = $restricao_alimentar;
    }

    public function getPreferenciaAlimentar() {
        return $this->preferencia_alimentar;
    }
    public function setPreferenciaAlimentar($preferencia_alimentar) {
        $this->preferencia_alimentar = $preferencia_alimentar;
    }
}
