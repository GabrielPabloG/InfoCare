<?php

class Pele {
    private $id;
    private $integridade;
    private $hidratacao;
    private $dermatite;
    private $prurido;
    private $micose_unha;
    private $escamacao;
    private $ictericia;
    private $ferida;
    private $petequia;
    private $hematoma;
    private $ulcera;
    private $grau_ulcera;
    private $outra_especificacao;

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getIntegridade() {
        return $this->integridade;
    }
    public function setIntegridade($integridade) {
        $this->integridade = $integridade;
    }

    public function getHidratacao() {
        return $this->hidratacao;
    }
    public function setHidratacao($hidratacao) {
        $this->hidratacao = $hidratacao;
    }

    public function getDermatite() {
        return $this->dermatite;
    }
    public function setDermatite($dermatite) {
        $this->dermatite = $dermatite;
    }

    public function getPrurido() {
        return $this->prurido;
    }
    public function setPrurido($prurido) {
        $this->prurido = $prurido;
    }

    public function getMicoseUnha() {
        return $this->micose_unha;
    }
    public function setMicoseUnha($micose_unha) {
        $this->micose_unha = $micose_unha;
    }

    public function getEscamacao() {
        return $this->escamacao;
    }
    public function setEscamacao($escamacao) {
        $this->escamacao = $escamacao;
    }

    public function getIctericia() {
        return $this->ictericia;
    }
    public function setIctericia($ictericia) {
        $this->ictericia = $ictericia;
    }

    public function getFerida() {
        return $this->ferida;
    }
    public function setFerida($ferida) {
        $this->ferida = $ferida;
    }

    public function getPetequia() {
        return $this->petequia;
    }
    public function setPetequia($petequia) {
        $this->petequia = $petequia;
    }

    public function getHematoma() {
        return $this->hematoma;
    }
    public function setHematoma($hematoma) {
        $this->hematoma = $hematoma;
    }

    public function getUlcera() {
        return $this->ulcera;
    }
    public function setUlcera($ulcera) {
        $this->ulcera = $ulcera;
    }

    public function getGrauUlcera() {
        return $this->grau_ulcera;
    }
    public function setGrauUlcera($grau_ulcera) {
        $this->grau_ulcera = $grau_ulcera;
    }

    public function getOutraEspecificacao() {
        return $this->outra_especificacao;
    }
    public function setOutraEspecificacao($outra_especificacao) {
        $this->outra_especificacao = $outra_especificacao;
    }
}