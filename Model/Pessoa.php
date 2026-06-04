<?php

class Pessoa {
    private $codPessoa;
    private $nomePessoa;
    private $cpfPessoa;
    private $sexoPessoa;
    private $nascPessoa;
    private $emailPessoa;
    private $senhaPessoa; 
    private $ruaEndereco;
    private $bairroEndereco;
    private $cepEndereco;
    private $numCasaEndereco;
    private $telefonePessoa = array();
    private $celularPessoa = array();

    public function getCodPessoa() {
        return $this->codPessoa;
    }
    public function setCodPessoa($codPessoa) {
        $this->codPessoa = $codPessoa;
    }

    public function getNomePessoa() {
        return $this->nomePessoa;
    }
    public function setNomePessoa($nomePessoa) {
        $this->nomePessoa = $nomePessoa;
    }
    
    public function getCpfPessoa() {
        return $this->cpfPessoa;
    }
    public function setCpfPessoa($cpfPessoa) {
        $this->cpfPessoa = $cpfPessoa;
    }
    
    public function getSexoPessoa() {
        return $this->sexoPessoa;
    }
    public function setSexoPessoa($sexoPessoa) {
        $this->sexoPessoa = $sexoPessoa;
    }
    
    public function getNascPessoa() {
        return $this->nascPessoa;
    }
    public function setNascPessoa($nascPessoa) {
        $this->nascPessoa = $nascPessoa;
    }

    public function getEmailPessoa() {
        return $this->emailPessoa;
    }
    public function setEmailPessoa($emailPessoa) {
        $this->emailPessoa = $emailPessoa;
    }

    public function getSenhaPessoa() {
        return $this->senhaPessoa;
    }
    public function setSenhaPessoa($senhaPessoa) {
        $this->senhaPessoa = $senhaPessoa;
    }

    public function getTelefonePessoa() {
        return $this->telefonePessoa;
    }
    public function setTelefonePessoa($telefonePessoa) {
        $this->telefonePessoa[] = $telefonePessoa;
    }

    public function getCelularPessoa() {
        return $this->celularPessoa;
    }
    public function setCelularPessoa($celularPessoa) {
        $this->celularPessoa[] = $celularPessoa;
    }
    
    public function getRuaEndereco() {
        return $this->ruaEndereco;
    }
    public function setRuaEndereco($ruaEndereco) {
        $this->ruaEndereco = $ruaEndereco;
    }
    
    public function getBairroEndereco() {
        return $this->bairroEndereco;
    }
    public function setBairroEndereco($bairroEndereco) {
        $this->bairroEndereco = $bairroEndereco;
    }
    
    public function getCepEndereco() {
        return $this->cepEndereco;
    }
    public function setCepEndereco($cepEndereco) {
        $this->cepEndereco = $cepEndereco;
    }
    
    public function getNumCasaEndereco() {
        return $this->numCasaEndereco;
    }
    public function setNumCasaEndereco($numCasaEndereco) {
        $this->numCasaEndereco = $numCasaEndereco;
}
    
}
