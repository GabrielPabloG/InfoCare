<?php

class Medicamento {
    private $id;
    private $nome;
    private $dosagem;
    private $horario;
    private $posologia;
    private $composicao;
    
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    
    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; }
    
    public function getDosagem() { return $this->dosagem; }
    public function setDosagem($dosagem) { $this->dosagem = $dosagem; }
    
    public function getHorario() { return $this->horario; }
    public function setHorario($horario) { $this->horario = $horario; }
    
    public function getPosologia() { return $this->posologia; }
    public function setPosologia($posologia) { $this->posologia = $posologia; }
    
    public function getComposicao() { return $this->composicao; }
    public function setComposicao($composicao) { $this->composicao = $composicao; }
}
?>