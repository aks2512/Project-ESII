<?php
    //Esse arquivo vai coletar formulario e instanciar a classe funcionário
    require_once('../classesphp/class.funcionario.php');
    include "conexao.php";

    $Nome = $_POST['Nome'];
    $Cargo = $_POST['Cargo'];
    $Modificado = $_POST['ModificadoEm'];
    $Regime = $_POST['Regime'];

    $VD = $_POST['VD'];
    $VR = $_POST['VR'];
    $TD = $_POST['TD'];
    $TR = $_POST['TR'];

    $OutrosDescontos = $_POST['OutrosDescontos'];

    $i = count($VR)-1;//Atribui a contagem de detalhes
    $j = count($VD)-1;

    $OutrosDescontos=floatval(str_replace(',','.',$OutrosDescontos));

    $Funcionario = new Funcionario($VR,$VD,$TR,$TD,$Nome,$Cargo,$Modificado,$OutrosDescontos,$Regime);

    $Funcionario->inserir_funcionario($i,$j);
?>