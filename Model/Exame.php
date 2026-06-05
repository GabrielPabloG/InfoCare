<?php

class Exame {
    private $id;
    private $hemograma_conclusao;
    private $urina_tipo;
    private $parasitologico_fezes;
    private $glicemia_jejum;
    private $colesterol;
    private $hepatite_tipo;
    private $hiv;
    private $vdrl;
    private $atestado_neurologico;
    private $raiox_pulmao;
    private $receituario_medico;

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getHemogramaConclusao() {
        return $this->hemograma_conclusao;
    }
    public function setHemogramaConclusao($hemograma_conclusao) {
        $this->hemograma_conclusao = $hemograma_conclusao;
    }

    public function getUrinaTipo() {
        return $this->urina_tipo;
    }
    public function setUrinaTipo($urina_tipo) {
        $this->urina_tipo = $urina_tipo;
    }

    public function getParasitologicoFezes() {
        return $this->parasitologico_fezes;
    }
    public function setParasitologicoFezes($parasitologico_fezes) {
        $this->parasitologico_fezes = $parasitologico_fezes;
    }

    public function getGlicemiaJejum() {
        return $this->glicemia_jejum;
    }
    public function setGlicemiaJejum($glicemia_jejum) {
        $this->glicemia_jejum = $glicemia_jejum;
    }

    public function getColesterol() {
        return $this->colesterol;
    }
    public function setColesterol($colesterol) {
        $this->colesterol = $colesterol;
    }

    public function getHepatiteTipo() {
        return $this->hepatite_tipo;
    }
    public function setHepatiteTipo($hepatite_tipo) {
        $this->hepatite_tipo = $hepatite_tipo;
    }

    public function getHiv() {
        return $this->hiv;
    }
    public function setHiv($hiv) {
        $this->hiv = $hiv;
    }

    public function getVdrl() {
        return $this->vdrl;
    }
    public function setVdrl($vdrl) {
        $this->vdrl = $vdrl;
    }

    public function getAtestadoNeurologico() {
        return $this->atestado_neurologico;
    }
    public function setAtestadoNeurologico($atestado_neurologico) {
        $this->atestado_neurologico = $atestado_neurologico;
    }

    public function getRaioxPulmao() {
        return $this->raiox_pulmao;
    }
    public function setRaioxPulmao($raiox_pulmao) {
        $this->raiox_pulmao = $raiox_pulmao;
    }

    public function getReceituarioMedico() {
        return $this->receituario_medico;
    }
    public function setReceituarioMedico($receituario_medico) {
        $this->receituario_medico = $receituario_medico;
    }
}
