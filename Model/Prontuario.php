<?php

class Prontuario {
    private $codProntuario;
    private $descProntuario;
    private $dataProntuario;
    private $diagnosticoEnfermagem;
    private $prescricaoEnfermagem;
    private $aprazamentoEnfermagem;
    
    public function getCodProntuario() {
        return $this->codProntuario;
    }
    public function setCodProntuario($codProntuario) {
        $this->codProntuario = $codProntuario;
    }
    
    public function getDescProntuario() {
        return $this->descProntuario;
    }
    public function setDescProntuario($descProntuario) {
        $this->descProntuario = $descProntuario;
    }
    
    public function getDataProntuario() {
        return $this->dataProntuario;
    }
    public function setDataProntuario($dataProntuario) {
        $this->dataProntuario = $dataProntuario;
    }
    	public function getDiagnosticoEnfermagem(){
		return $this->diagnosticoEnfermagem;
	}

	public function setDiagnosticoEnfermagem($diagnosticoEnfermagem){
		$this->diagnosticoEnfermagem = $diagnosticoEnfermagem;
	}

	public function getPrescricaoEnfermagem(){
		return $this->prescricaoEnfermagem;
	}

	public function setPrescricaoEnfermagem($prescricaoEnfermagem){
		$this->prescricaoEnfermagem = $prescricaoEnfermagem;
	}

	public function getAprazamentoEnfermagem(){
		return $this->aprazamentoEnfermagem;
	}

	public function setAprazamentoEnfermagem($aprazamentoEnfermagem){
		$this->aprazamentoEnfermagem = $aprazamentoEnfermagem;
	}
}