<?php

    namespace App\Model;

    class Desconto{
        //atributos da desconto
        private $Id;
        private $Nome;
        private $Valor;
        private $Delete;

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

        public function setValor($Valor){
            $this->Valor = $Valor;
        }

        public function getValor(){
            return $this->Valor;
        }

        public function setDelete($Delete){
            $this->Delete = $Delete;
        }

        public function getDelete(){
            return $this->Delete;
        }
    }

?>