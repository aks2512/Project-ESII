<?php

    namespace App\Model;

    class PesquisaInteresses{

        //atributos 
        private $ip;
        private $filtro;
        private $tabela;

        //Getters e Setters
        public function setIp($ip){
            $this->ip=$ip;
        }

        public function getIp(){
            return $this->ip;
        }

        public function setFiltro($filtro){
            $this->filtro=$filtro;
        }

        public function getFiltro(){
            return $this->filtro;
        }

        public function setTabela($tabela){
            $this->tabela=$tabela;
        }

        public function getTabela(){
            return $this->tabela;
        }

    }

?>