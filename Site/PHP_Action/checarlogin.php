<?php
    session_start();

    require_once('conexao.php');

    if(empty($_POST['user'])or(empty($_POST['pass'])))
    {
        header('location: ../Login.php');
        exit();
    }

    $usuario = mysqli_real_escape_string($conn, $_POST['user']);
    $senha = mysqli_real_escape_string($conn, $_POST['pass']);

    $query = "SELECT id_admin FROM administradores WHERE Usuario = '$usuario' AND Senha = '$senha'";
    $result = mysqli_query($conn,$query);

    if(!$result) {
        die('Could not get data: ');
     }

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if($row>0)
    {
        ?>
        <h2>"conectado com sucesso!"</h2>
        <?php

        header('location: ../BD.php');
    }
    else
    {
        ?>
        <h2>"usuario e/ou senha incorretos!"</h2>
        <?php
    }
?>