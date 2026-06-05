<?php

class Pulmonar {
    private $id;
    private $tipo_tosse;
    private $auscultacao;
    private $tipo_dispneia;

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getTipoTosse() {
        return $this->tipo_tosse;
    }
    public function setTipoTosse($tipo_tosse) {
        $this->tipo_tosse = $tipo_tosse;
    }

    public function getAuscultacao() {
        return $this->auscultacao;
    }
    public function setAuscultacao($auscultacao) {
        $this->auscultacao = $auscultacao;
    }

    public function getTipoDispneia() {
        return $this->tipo_dispneia;
    }
    public function setTipoDispneia($tipo_dispneia) {
        $this->tipo_dispneia = $tipo_dispneia;
    }
}
