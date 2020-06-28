<?php

    require_once 'vendor/autoload.php';

    $administrador = new \App\Model\Administrador();
    $administradorDao = new \App\Model\AdministradorDao();

    $administrador->setUsuario($_POST['Usuario']);
    $administrador->setSenha($_POST['Senha']);

    $administradorDao->create($administrador);

    header("Location: cadastroAdmForm.php");

?>