<?php

namespace App\Model;

//Cria conexão com o DB
class DB{

    private static $con;

    public static function getCon(){
        if(!isset(self::$con)):
            self::$con = new \PDO('mysql:host=localhost;dbname=projectteste;charset=utf8','root','');
        endif;
        return self::$con;
    }

}

?>