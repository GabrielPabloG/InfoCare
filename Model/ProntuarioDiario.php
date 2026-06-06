<?php

class ProntuarioDiario {
    private $id;
    private $idoso_id;         
    private $funcionario_id;   
    private $observacao;       
    private $data_registro;    


    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getIdosoId() { return $this->idoso_id; }
    public function setIdosoId($idoso_id) { $this->idoso_id = $idoso_id; }

    public function getFuncionarioId() { return $this->funcionario_id; }
    public function setFuncionarioId($funcionario_id) { $this->funcionario_id = $funcionario_id; }

    public function getObservacao() { return $this->observacao; }
    public function setObservacao($observacao) { $this->observacao = $observacao; }

    public function getDataRegistro() { return $this->data_registro; }
    public function setDataRegistro($data_registro) { $this->data_registro = $data_registro; }
}
?>