<?php
    
class Medicamento {
    private $codMedicamento;
    private $nomeMedicamento;
    private $dosagemMedicamento;
    private $horarioMedicamento;
    private $posologia;
    private $composicaoMedicamento;
    
    public function getCodMedicamento() {
        return $this->codMedicamento;
    }
    public function setCodMedicamento($codMedicamento) {
        $this->codMedicamento = $codMedicamento;
    }
    
    public function getNomeMedicamento() {
        return $this->nomeMedicamento;
    }
    public function setNomeMedicamento($nomeMedicamento) {
        $this->nomeMedicamento = $nomeMedicamento;
    }
    
    public function getDosagemMedicamento() {
        return $this->dosagemMedicamento;
    }
    public function setDosagemMedicamento($dosagemMedicamento) {
        $this->dosagemMedicamento = $dosagemMedicamento;
    }
    
    public function getHorarioMedicamento() {
        return $this->horarioMedicamento;
    }
    public function setHorarioMedicamento($horarioMedicamento) {
        $this->horarioMedicamento = $horarioMedicamento;
    }
    
    public function getPosologia() {
        return $this->posologia;
    }
    public function setPosologia($posologia) {
        $this->posologia = $posologia;
    }
    
    public function getComposicaoMedicamento() {
        return $this->composicaoMedicamento;
    }
    public function setComposicaoMedicamento($composicaoMedicamento) {
        $this->composicaoMedicamento = $composicaoMedicamento;
    }
}