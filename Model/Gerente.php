<?php
	class Gerente {
		private $nomeGerente;
		private $cpfGerente;
		private $sexoGerente;
        private $NascGerente;
        private $salarioGerente;
        private $emailGerente;
        private $senhaGerente;
        private $codEnderecoGerente;
        private $codTelefoneGerente;
        private $codCelularGerente;
		
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
        
        public function getCodEnderecoGerente(){
            return $this->codEnderecoGerente;
        }
        public function setCodEnderecoGerente($codEnderecoGerente){
            $this->codEnderecoGerente = $codEnderecoGerente;
        }
        
        public function getCodTelefoneGerente(){
            return $this->codTelefoneGerente;
        }
        public function setCodTelefoneGerent($codTelefoneGerente){
            $this->codTelefoneGerente = $codTelefoneGerente;
        }
        
        public function getCodCelularGerente(){
            return $this->codCelularGerente;
        }
        public function setCodCelularGerente($codCelularGerente){
            $this->codCelularGerente = $codCelularGerente;
        }
	}