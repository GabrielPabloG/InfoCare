<?php
	class Gerente {
		private $nomeGerente;
		private $cpfGerente;
		private $sexoGerente;
        private $NascGerente;
        private $salarioGerente;
        private $emailGerente;
        private $senhaGerente;

        private $rua;
        private $bairro;
        private $cep;
        private $numero_casa;
		
		public function getNomeGerente(){
            return $this->nomeGerente;
        }
        public function setNomeGerente($nomeGerente){
            $this->nomeGerente = $nomeGerente;
        }
		
		public function getCpfGerente(){
			return $this->cpfGerente;
		}
		public function setCpfGerente($cpfGerente){
			$this->cpfGerente = $cpfGerente;
		}
		
		public function getSexoGerente(){
			return $this->sexoGerente;
		}
		public function setSexoGerente($sexoGerente){
			$this->sexoGerente = $sexoGerente;
		}
        
        public function getNascGerente(){
            return $this->NascGerente;
        }
        public function setNascGerente($NascGerente){
            $this->NascGerente = $NascGerente;
        }
        
        public function getSalarioGerente(){
            return $this->salarioGerente;
        }
        public function setSalarioGerente($salarioGerente){
            $this->salarioGerente = $salarioGerente;
        }
        
        public function getEmailGerente() {
            return $this->emailGerente;
        }
        public function setEmailGerente($emailGerente) {
            $this->emailGerente = $emailGerente;
        }
        
        public function getSenhaGerente() {
            return $this->senhaGerente;
        }
        public function setSenhaGerente($senhaGerente) {
            $this->senhaGerente = $senhaGerente;
        }
        
        public function getRua() {
            return $this->rua;
        }
        public function setRua($rua) {
            $this->rua = $rua;
        }
        public function getBairro() {
            return $this->bairro;
        }
        public function setBairro($bairro) {
            $this->bairro = $bairro;
        }
        public function getCep() {
            return $this->cep;
        }
        public function setCep($cep) {
            $this->cep = $cep;
        }
        public function getNumeroCasa() {
            return $this->numero_casa;
        }
        public function setNumeroCasa($numero_casa) {
            $this->numero_casa = $numero_casa;
        }
	}