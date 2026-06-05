<?php

class Eliminacao {
    private $id;
    private $frequencia_evacuacao;
    private $aspecto_fezes;
    private $coloracao_urina;
    private $odor_urina;
    private $frequencia_urina;
    private $queixa_gases;
    private $usa_fralda;
    private $marca_fralda;

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getFrequenciaEvacuacao() {
        return $this->frequencia_evacuacao;
    }
    public function setFrequenciaEvacuacao($frequencia_evacuacao) {
        $this->frequencia_evacuacao = $frequencia_evacuacao;
    }

    public function getAspectoFezes() {
        return $this->aspecto_fezes;
    }
    public function setAspectoFezes($aspecto_fezes) {
        $this->aspecto_fezes = $aspecto_fezes;
    }

    public function getColoracaoUrina() {
        return $this->coloracao_urina;
    }
    public function setColoracaoUrina($coloracao_urina) {
        $this->coloracao_urina = $coloracao_urina;
    }

    public function getOdorUrina() {
        return $this->odor_urina;
    }
    public function setOdorUrina($odor_urina) {
        $this->odor_urina = $odor_urina;
    }

    public function getFrequenciaUrina() {
        return $this->frequencia_urina;
    }
    public function setFrequenciaUrina($frequencia_urina) {
        $this->frequencia_urina = $frequencia_urina;
    }

    public function getQueixaGases() {
        return $this->queixa_gases;
    }
    public function setQueixaGases($queixa_gases) {
        $this->queixa_gases = $queixa_gases;
    }

    public function getUsaFralda() {
        return $this->usa_fralda;
    }
    public function setUsaFralda($usa_fralda) {
        $this->usa_fralda = $usa_fralda;
    }

    public function getMarcaFralda() {
        return $this->marca_fralda;
    }
    public function setMarcaFralda($marca_fralda) {
        $this->marca_fralda = $marca_fralda;
    }
}
