<?php

    namespace App\Model;

    class Administrador{

    //atributos Administrador
    private $Id;
    private $Usuario;
    private $Senha;

    //Getters e Setters
    public function setId($Id){
        $this->Id=$Id;
    }

    public function getId(){
        return $this->Id;
    }

    public function setUsuario($Usuario){
        $this->Usuario=$Usuario;
    }

    public function getUsuario(){
        return $this->Usuario;
    }

    public function setSenha($Senha){
        $this->Senha=$Senha;
    }

    public function getSenha(){
        return $this->Senha;
    }

    }

?>