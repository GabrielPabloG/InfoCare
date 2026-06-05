<?php

class Locomocao {
    private $id;
    private $locomocao_sozinho;
    private $cadeirante;
    private $tempo_cadeirante;
    private $acamado;
    private $tempo_acamado;
    private $apoio_fisico;
    private $esporte_terapia;

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getLocomocaoSozinho() {
        return $this->locomocao_sozinho;
    }
    public function setLocomocaoSozinho($locomocao_sozinho) {
        $this->locomocao_sozinho = $locomocao_sozinho;
    }

    public function getCadeirante() {
        return $this->cadeirante;
    }
    public function setCadeirante($cadeirante) {
        $this->cadeirante = $cadeirante;
    }

    public function getTempoCadeirante() {
        return $this->tempo_cadeirante;
    }
    public function setTempoCadeirante($tempo_cadeirante) {
        $this->tempo_cadeirante = $tempo_cadeirante;
    }

    public function getAcamado() {
        return $this->acamado;
    }
    public function setAcamado($acamado) {
        $this->acamado = $acamado;
    }

    public function getTempoAcamado() {
        return $this->tempo_acamado;
    }
    public function setTempoAcamado($tempo_acamado) {
        $this->tempo_acamado = $tempo_acamado;
    }

    public function getApoioFisico() {
        return $this->apoio_fisico;
    }
    public function setApoioFisico($apoio_fisico) {
        $this->apoio_fisico = $apoio_fisico;
    }

    public function getEsporteTerapia() {
        return $this->esporte_terapia;
    }
    public function setEsporteTerapia($esporte_terapia) {
        $this->esporte_terapia = $esporte_terapia;
    }
}
