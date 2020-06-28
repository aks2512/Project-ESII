<?php

    session_start();

    require_once 'vendor/autoload.php';

    $usuario = $_POST['Usuario'];
    $senha = MD5($_POST['Senha']);

    $administradorDao = new \App\Model\AdministradorDao();
    $resultado = $administradorDao->verificaAdm($usuario,$senha);

    if (!empty($resultado)) {
        $_SESSION['usuario'] = $usuario;
        header("Location: administracao.php");
        
    }else{
        $_SESSION['mensagemErro'] = "Usuario ou senha inválidos";
        header("Location: Login.php?erro=1");
    }
?>