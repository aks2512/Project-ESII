<?php

    namespace App\Model;

    class Projeto{

        //atributos projeto
        private $Tipo_Projeto;
        private $Ano;
        private $Id;
        private $Autor;
        private $Link;
        private $Assunto;
        private $Anotacao;

        public function setTipo_Projeto($Tipo_Projeto){
            $this->Tipo_Projeto = $Tipo_Projeto;
        }

        public function getTipo_Projeto(){
            return $this->Tipo_Projeto;
        }
        
        public function setAno($Ano){
            $this->Ano = $Ano;
        }

        public function getAno(){
            return $this->Ano;
        }

        public function setId($Id){
            $this->Id = $Id;
        }

        public function getId(){
            return $this->Id;
        }

        public function setAutor($Autor){
            $this->Autor = $Autor;
        }

        public function getAutor(){
            return $this->Autor;
        }

        public function setLink($Link){
            $this->Link = $Link;
        }

        public function getLink(){
            return $this->Link;
        }

        public function setAssunto($Assunto){
            $this->Assunto = $Assunto;
        }

        public function getAssunto(){
            return $this->Assunto;
        }

        public function setAnotacao($Anotacao){
            $this->Anotacao = $Anotacao;
        }

        public function getAnotacao(){
            return $this->Anotacao;
        }

    }

?>