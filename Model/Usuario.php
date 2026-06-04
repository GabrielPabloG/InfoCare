<?php
	class Usuario {
		private $nome;
		private $email;
		private $senha;
        private $estado;
        private $cidade;
		
		public function getNome(){
            return $this->nome;
        }
        public function setNome($nome){
            $this->nome = $nome;
        }
		
		public function getEmail(){
			return $this->email;
		}
		public function setEmail($email){
			$this->email = $email;
		}
		
		public function getSenha(){
			return $this->senha;
		}
		public function setSenha($senha){
			$this->senha = $senha;
		}
        
        public function getEstado(){
            return $this->estado;
        }
        public function setEstado($estado){
            $this->estado = $estado;
        }
        
        public function getCidade(){
            return $this->cidade;
        }
        public function setCidade($cidade){
            $this->estado = $cidade;
        }
	}