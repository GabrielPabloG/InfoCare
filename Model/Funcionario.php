<?php
	class Funcionario {
        private $codFuncionario;
        private $salarioFuncionario;
        
        public function getCodFuncionario() {
            return $this->codFuncionario;
        }
        public function setCodFuncionario($codFuncionario) {
            $this->codFuncionario = $codFuncionario;
        }
        
        public function getSalarioFuncionario() {
            return $this->salarioFuncionario;
        }
        public function setSalarioFuncionario($salarioFuncionario) {
            $this->salarioFuncionario = $salarioFuncionario;
        }
    }
    