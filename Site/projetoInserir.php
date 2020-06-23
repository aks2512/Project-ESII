<?php

    require_once 'vendor/autoload.php';


    $projeto = new \App\Model\Projeto();
    $projeto->setTipo_Projeto($_POST['tipo_projeto']);
    $projeto->setAno(intval($_POST['ano']));
    $projeto->setAutor($_POST['autor']);
    $projeto->setLink($_POST['link']);
    $projeto->setAssunto($_POST['assunto']);
    $projeto->setAnotacao($_POST['anotacao']);
    $projeto->setId($_POST['id']);

    $projetoDao = new \App\Model\ProjetoDao();
    $projetoDao->create($projeto);

    header('Location: administracao.php?p=projetos');
    exit;

?>