<?php

    namespace App\Model;

    class FuncionarioPrefeitura{

        //atributos funcionario
        private $Id;
        private $Nome;
        private $Cargo;
        private $Regime;
        private $Remuneracoes;
        private $Descontos;
        private $OutrosDescontos;
        private $TBruto;
        private $TLiquido;
        private $TDesconto;
        private $rgf;

        public function setId($Id){
            $this->Id = $Id;
        }

        public function getId(){
            return $this->Id;
        }

        public function setNome($Nome){
            $this->Nome = $Nome;
        }

        public function getNome(){
            return $this->Nome;
        }

        public function setCargo($Cargo){
            $this->Cargo = $Cargo;
        }

        public function getCargo(){
            return $this->Cargo;
        }

        public function setRegime($Regime){
            $this->Regime = $Regime;
        }

        public function getRegime(){
            return $this->Regime;
        }

        public function setRemuneracoes($Remuneracoes){
            $this->Remuneracoes = $Remuneracoes;
        }

        public function getRemuneracoes(){
            return $this->Remuneracoes;
        }

        public function setDescontos($Descontos){
            $this->Descontos = $Descontos;
        }

        public function getDescontos(){
            return $this->Descontos;
        }

        public function setOutrosDescontos($OutrosDescontos){
            $this->OutrosDescontos = $OutrosDescontos;
        }

        public function getOutrosDescontos(){
            return $this->OutrosDescontos;
        }

        public function setTBruto(){
            $soma = 0;
            foreach ($this->Remuneracoes as $key => $value) {
                if($value->getDelete() != "true"){
                    $soma += $value->getValor();
                }
            }    
            $this->TBruto = $soma;    
        }

        public function getTBruto(){
            return $this->TBruto;
        }

        public function setTDesconto(){
            $soma = 0;
            foreach ($this->Descontos as $key => $value) {
                if($value->getDelete() != "true"){
                    $soma += $value->getValor();
                }
            }    
            $soma = $soma + $this->OutrosDescontos; 
            $this->TDesconto = $soma;    
        }

        public function getTDesconto(){
            return $this->TDesconto;
        }

        public function setTLiquido(){
            $this->TLiquido = $this->TBruto - $this->TDescontos;
        }

        public function getTLiquido(){
            return $this->TLiquido;
        }

        public function setRgf($rgf){
            $this->rgf = $rgf;
        }

        public function getRgf(){
            return $this->rgf;
        }

    }

?>