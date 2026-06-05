<?php

class Idoso {
    private $codIdoso;
    private $nomeIdoso;
    private $sexoIdoso;
    private $cpfIdoso;
    private $nascIdoso;
    private $prontuarioFixoId;
    private $codResponsavel;
    
    public function getCodIdoso() {
        return $this->codIdoso;
    }
    public function setCodIdoso($codIdoso) {
        $this->codIdoso = $codIdoso;
    }
    
    public function getNomeIdoso() {
        return $this->nomeIdoso;
    }
    public function setNomeIdoso($nomeIdoso) {
        $this->nomeIdoso = $nomeIdoso;
    }
    
    public function getSexoIdoso() {
        return $this->sexoIdoso;
    }
    public function setSexoIdoso($sexoIdoso) {
        $this->sexoIdoso = $sexoIdoso;
    }
    
    public function getCpfIdoso() {
        return $this->cpfIdoso;
    }
    public function setCpfIdoso($cpfIdoso) {
        $this->cpfIdoso = $cpfIdoso;
    }
    
    public function getNascIdoso() {
        return $this->nascIdoso;
    }
    public function setNascIdoso($nascIdoso) {
        $this->nascIdoso = $nascIdoso;
    }
    
    public function getCodResponsavel() {
        return $this->codResponsavel;
    }
    public function setCodResponsavel($codResponsavel) {
        $this->codResponsavel = $codResponsavel;
    }

    public function getProntuarioFixoId() {
        return $this->prontuarioFixoId;
    }

    public function setProntuarioFixoId($prontuarioFixoId) {
        $this->prontuarioFixoId = $prontuarioFixoId;
    }
}