<?php

public class ProntuarioDiario {
    private $id;
    private $data;
    private $locomocao;
    private $alimentacao;
    private $relacionamento;
    private $pulmonar;

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getData() {
        return $this->data;
    }
    public function setData($data) {
        $this->data = $data;
    }

    public function getLocomocao() {
        return $this->locomocao;
    }
    public function setLocomocao($locomocao) {
        $this->locomocao = $locomocao;
    }

    public function getAlimentacao() {
        return $this->alimentacao;
    }
    public function setAlimentacao($alimentacao) {
        $this->alimentacao = $alimentacao;
    }

    public function getRelacionamento() {
        return $this->relacionamento;
    }
    public function setRelacionamento($relacionamento) {
        $this->relacionamento = $relacionamento;
    }

    public function getPulmonar() {
        return $this->pulmonar;
    }
    public function setPulmonar($pulmonar) {
        $this->pulmonar = $pulmonar;
    }
}