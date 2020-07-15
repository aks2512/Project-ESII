<?php

    session_start();
    
    require_once 'vendor/autoload.php';

    $ip = $_SESSION['ip_user'];
    $filtro = $_POST['projeto'];
    $tabela = $_POST['tabela'];

    $pesquisaInteresse = new \App\Model\PesquisaInteresses();
    $pesquisaInteresseDao = new \App\Model\PesquisaInteressesDao();
    
    $pesquisaInteresse->setIp($ip);
    $pesquisaInteresse->setFiltro($filtro);
    $pesquisaInteresse->setTabela($tabela);

    $pesquisaInteresseDao->create($pesquisaInteresse);
?>

