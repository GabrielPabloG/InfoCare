<?php
	class Funcionario {
        private $codFuncionario;
        private $cargoFuncionario;
        private $salarioFuncionario;
        
        public function getCodFuncionario() {
            return $this->codFuncionario;
        }
        public function setCodFuncionario($codFuncionario) {
            $this->codFuncionario = $codFuncionario;
        }
        
        public function getCargoFuncionario() {
            return $this->cargoFuncionario;
        }
        public function setCargoFuncionario($cargoFuncionario) {
            $this->cargoFuncionario = $cargoFuncionario;
        }
        
        public function getSalarioFuncionario() {
            return $this->salarioFuncionario;
        }
        public function setSalarioFuncionario($salarioFuncionario) {
            $this->salarioFuncionario = $salarioFuncionario;
        }
    }
    