<?php

    namespace App\Model;

    class FuncionarioCamara{

        //atributos funcionario
        private $Id;
        private $Nome;
        private $Cargo;
        private $Vencimento_Base;
        private $Outros_Vencimentos;
        private $Previdencia;
        private $OutrosDescontos;
        private $TBruto;
        private $TLiquido;
        private $TDesconto;
        private $rgf;
        private $IRRF;

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

        public function setVencimento_Base($Vencimento_Base){
            $this->Vencimento_Base = $Vencimento_Base;
        }

        public function getVencimento_Base(){
            return $this->Vencimento_Base;
        }

        public function setOutros_Vencimentos($Outros_Vencimentos){
            $this->Outros_Vencimentos = $Outros_Vencimentos;
        }

        public function getOutros_Vencimentos(){
            return $this->Outros_Vencimentos;
        }

        public function setPrevidencia($Previdencia){
            $this->Previdencia = $Previdencia;
        }

        public function getPrevidencia(){
            return $this->Previdencia;
        }

        public function setOutrosDescontos($OutrosDescontos){
            $this->OutrosDescontos = $OutrosDescontos;
        }

        public function getOutrosDescontos(){
            return $this->OutrosDescontos;
        }

        public function setTBruto($TBruto){
            $this->TBruto = $TBruto;
        }

        public function getTBruto(){
            return $this->TBruto;
        }

        public function setTDesconto($TDesconto){
            $this->TDesconto = $TDesconto;
        }

        public function getTDesconto(){
            return $this->TDesconto;
        }

        public function setTLiquido(){
            $this->TLiquido = $this->TBruto - $this->TDesconto;
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

        public function setIRRF($IRRF){
            $this->IRRF = $IRRF;
        }

        public function getIRRF(){
            return $this->IRRF;
        }

    }

?>