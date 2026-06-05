<?php

class Relacionamento {
    private $id;
    private $status_comunicacao;
    private $agressividade;
    private $temperamento;
    private $anterioridade_casa_repouso;
    private $irritabilidade;

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getStatusComunicacao() {
        return $this->status_comunicacao;
    }
    public function setStatusComunicacao($status_comunicacao) {
        $this->status_comunicacao = $status_comunicacao;
    }

    public function getAgressividade() {
        return $this->agressividade;
    }
    public function setAgressividade($agressividade) {
        $this->agressividade = $agressividade;
    }

    public function getTemperamento() {
        return $this->temperamento;
    }
    public function setTemperamento($temperamento) {
        $this->temperamento = $temperamento;
    }

    public function getAnterioridadeCasaRepouso() {
        return $this->anterioridade_casa_repouso;
    }
    public function setAnterioridadeCasaRepouso($anterioridade_casa_repouso) {
        $this->anterioridade_casa_repouso = $anterioridade_casa_repouso;
    }

    public function getIrritabilidade() {
        return $this->irritabilidade;
    }
    public function setIrritabilidade($irritabilidade) {
        $this->irritabilidade = $irritabilidade;
    }
}
