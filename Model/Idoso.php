<?php

class Idoso {
    private $id;
    private $nome;
    private $cpf;
    private $sexo;
    private $nascimento;
    private $responsavelId;
    private $prontuarioFixoId;

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCpf() {
        return $this->cpf;
    }
    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getSexo() {
        return $this->sexo;
    }
    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function getNascimento() {
        return $this->nascimento;
    }
    public function setNascimento($nascimento) {
        $this->nascimento = $nascimento;
    }

    public function getResponsavelId() {
        return $this->responsavelId;
    }
    public function setResponsavelId($responsavelId) {
        $this->responsavelId = $responsavelId;
    }

    public function getProntuarioFixoId() {
        return $this->prontuarioFixoId;
    }
    public function setProntuarioFixoId($prontuarioFixoId) {
        $this->prontuarioFixoId = $prontuarioFixoId;
    }
}